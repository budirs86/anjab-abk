<?php

namespace App\Http\Controllers;

use App\Models\AbkAnjab;
use App\Models\Ajuan;
use App\Models\AjuanUnitKerja;
use App\Models\DetailAbk;
use App\Models\Jabatan;
use App\Models\JabatanDiajukan;
use App\Models\Role;
use App\Models\RoleVerifikasi;
use App\Models\UnitKerja;
use App\Models\UraianTugas;
use App\Models\UraianTugasDiajukan;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class AbkController extends Controller
{
    public function index()
    {
        $title = 'Daftar Ajuan ABK';

        if (auth()->user()->hasRole('Admin Kepegawaian') || auth()->user()->hasRole('Wakil Rektor 2')) {
            $ajuans = Ajuan::isRoot()->where('jenis', 'abk')->get();
            return view('abk.ajuans2', compact('title', 'ajuans'));
        }

        $ajuans = Ajuan::where('jenis', 'abk')->whereHas('detailAbk', function ($query) {
            $query->where('unit_kerja_id', auth()->user()->unit_kerja_id);
        })->get();


        return view('abk.ajuans', compact('title', 'ajuans'));
    }

    public function createAjuan()
    {
        return view('abk.buat-ajuan', [
            'title' => 'Buat Ajuan ABK',
            'jabatans' => JabatanDiajukan::all()
        ]);
    }

    public function storeAjuan(Ajuan $anjab)
    {
        // create a parent ABK
        $parentAbk = Ajuan::create([
            'tahun' => now()->year,
            'jenis' => 'abk'
        ]);

        // define who can verify the parent ABK
        RoleVerifikasi::create([
            'ajuan_id' => $parentAbk->id,
            'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
            'is_approved' => false
        ]);
        RoleVerifikasi::create([
            'ajuan_id' => $parentAbk->id,
            'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
            'is_approved' => false
        ]);

        // get all unique unit kerja from the jabatan
        $unitKerjas = UnitKerja::all();
        // for each unit kerja, 
        // create ABK with current year as 'tahun' and abk as 'jenis'
        foreach ($unitKerjas as $unitKerja) {
            $abk = Ajuan::create([
                'parent_id' => $parentAbk->id,
                'tahun' => now()->year,
                'jenis' => 'abk'
            ]);

            // also create instance of abk_anjab to map which ones are the abk for an anjab
            AbkAnjab::create([
                'abk_id' => $abk->id,
                'anjab_id' => $anjab->id
            ]);

            // also create role verifikasi for each abk based on unsur of the unit kerja
            if (in_array($unitKerja->unsur->nama, [
                'Lembaga',
                'Badan',
                'Biro',
                'Direktorat',
                'Unit Pelaksana Teknis',
                'Kantor',
                'Satuan Pengawas Internal',
                'Dewan Penasihat Universitas'
            ])) {
                // create roles that can verify the ajuan
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Operator Unit Kerja')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Manajer Unit Kerja')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Kepala Unit Kerja')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
                    'is_approved' => false
                ]);
            }

            if ($unitKerja->unsur->nama == 'Fakultas/Sekolah') {
                // create roles that can verify the ajuan
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Operator Unit Kerja')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Manajer Tata Usaha')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Wakil Dekan 2')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
                    'is_approved' => false
                ]);
                RoleVerifikasi::create([
                    'ajuan_id' => $abk->id,
                    'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
                    'is_approved' => false
                ]);
            }

            // also create detail ABK instance for each uraian tugas for each jabatan in the unit kerja
            $jabatanUnitKerjas = $unitKerja->jabatansWithin();
            foreach ($jabatanUnitKerjas as $jabatanUnitKerja) {
                foreach ($jabatanUnitKerja->jabatan->uraianTugas as $uraianTugas) {
                    DetailAbk::create([
                        'ajuan_id' => $abk->id,
                        'unit_kerja_id' => $unitKerja->id,
                        'jabatan_diajukan_id' => $jabatanUnitKerja->jabatan_id,
                        'uraian_tugas_diajukan_id' => $uraianTugas->id
                    ]);
                }
            }
        }

        return redirect()->route('abk.ajuans');
    }

    public function showAjuan(Ajuan $anjab)
    {
        $title = 'Ajuan ABK';
        $periode = $anjab->tahun;
        // if the logged in user has role "Admin Kepegawaian", display all unit kerja
        // else, display only the unit kerja of the logged in user
        if (auth()->user()->hasRole('Admin Kepegawaian')) {
            $unit_kerjas = UnitKerja::all();
        } else if (auth()->user()->hasRole('Operator Unit Kerja')) {
            $unit_kerjas = UnitKerja::where('id', auth()->user()->unit_kerja_id)->get();
        }

        return view('abk.ajuan', compact('title', 'anjab', 'periode', 'unit_kerjas'));
    }

    public function showUnitKerja(Ajuan $anjab, Ajuan $abk)
    {
        $title = 'Lihat Informasi ABK';
        $unit_kerja = $abk->detailAbk()->latest()->first()->unitKerja;
        $jabatans = $unit_kerja->jabatansWithin();

        return view('abk.unitkerja.show', compact('title', 'anjab', 'abk', 'jabatans', 'unit_kerja'));
    }

    public function editUnitKerja(Ajuan $anjab, Ajuan $abk)
    {
        $title = 'Edit Informasi ABK';
        $unit_kerja = $abk->detailAbk()->latest()->first()->unitKerja;
        $jabatanUnitKerjaIds = $unit_kerja->jabatansWithin()->pluck('jabatan_id');
        $jabatans = JabatanDiajukan::whereIn('id', $jabatanUnitKerjaIds)->get();

        return view('abk.unitkerja.edit', compact('title', 'anjab', 'unit_kerja', 'jabatans', 'abk'));
    }

    public function createJabatan(JabatanDiajukan $jabatan)
    {
        return view('abk.jabatan.create', [
            'jabatan' => $jabatan,
            'title' => 'Buat Informasi Beban Kerja'
        ]);
    }

    public function showJabatan(Ajuan $anjab, Ajuan $abk, JabatanDiajukan $jabatan)
    {
        $title = 'Lihat Informasi ABK';
        $wpt = DetailAbk::where('jabatan_diajukan_id', $jabatan->id)->selectRaw('SUM(waktu_penyelesaian * jumlah_hasil_kerja) as total_value')->value('total_value');

        return view('abk.jabatan.show', compact('title', 'anjab', 'abk', 'jabatan', 'wpt'));
    }

    public function editJabatan(Ajuan $anjab, Ajuan $abk, JabatanDiajukan $jabatan)
    {
        $title = 'Edit Informasi ABK';
        $uraians = $jabatan->uraianTugas;
        $wpt = DetailAbk::where('jabatan_diajukan_id', $jabatan->id)->selectRaw('SUM(waktu_penyelesaian * jumlah_hasil_kerja) as total_value')->value('total_value');

        return view('abk.jabatan.edit', compact('title', 'anjab', 'abk', 'jabatan', 'uraians', 'wpt'));
    }

    public function storeDetailAbk(Request $request, Ajuan $anjab, Ajuan $abk, JabatanDiajukan $jabatan, DetailAbk $detail_abk)
    {
        $detail_abk->update([
            'hasil_kerja' => $request->hasil_kerja,
            'jumlah_hasil_kerja' => $request->jumlah_hasil_kerja,
            'waktu_penyelesaian' => $request->waktu_penyelesaian,
        ]);

        return redirect()->back()->with('success', 'Detail ABK berhasil disimpan');
    }

    public function updateAjuan(Ajuan $anjab, Ajuan $abk)
    {
        Verifikasi::create([
            'ajuan_id' => $abk->id,
            'user_id' => auth()->user()->id,
            'is_approved' => true,
            'catatan' => null
        ]);

        RoleVerifikasi::where('ajuan_id', $abk->id)
            ->where('role_id', auth()->user()->roles->first()->id)
            ->update(['is_approved' => true]);

        return redirect()->route('abk.ajuans')->with('success', 'Ajuan ABK berhasil disimpan');
    }

    public function abkVerifikasi(Ajuan $abk)
    {
        // When user accepts the ajuan, verification instance is created, 
        // and is_approved in RoleVerifikasi is set to true
        Verifikasi::create([
            'ajuan_id' => $abk->id,
            'user_id' => auth()->user()->id,
            'is_approved' => true,
            'catatan' => null
        ]);
        RoleVerifikasi::where('ajuan_id', $abk->id)
            ->where('role_id', auth()->user()->roles->first()->id)
            ->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Verifikasi berhasil');
    }

    // When user rejects the ajuan, verification instance is created, 
    // is_approved in RoleVerifikasi from the previous role is set to false
    // and is_approved in RoleVerifikasi from the current role is also set to false
    public function abkRevisi(Ajuan $abk)
    {
        // Create a new verification instance
        Verifikasi::create([
            'ajuan_id' => $abk->id,
            'user_id' => auth()->user()->id,
            'is_approved' => false,
            'catatan' => request('catatan')
        ]);

        // Get all role ids that can verify the ajuan
        $verificatorIds = RoleVerifikasi::where('ajuan_id', $abk->id)->get()->pluck('role_id')->toArray();
        // Get the role id of the previous verificator
        $previousVerificatorRoleId = $verificatorIds[array_search(auth()->user()->roles->first()->id, $verificatorIds) - 1];

        // Set is_approved in RoleVerifikasi from the previous role to false
        RoleVerifikasi::where('ajuan_id', $abk->id)
            ->where('role_id', $previousVerificatorRoleId)
            ->update(['is_approved' => false]);

        // Set is_approved in RoleVerifikasi from the current role to false
        RoleVerifikasi::where('ajuan_id', $abk->id)
            ->where('role_id', auth()->user()->roles->first()->id)
            ->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'Revisi berhasil');
    }
}
