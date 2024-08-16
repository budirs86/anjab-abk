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

    $ajuans = Ajuan::where('jenis', 'abk')->whereHas('detailAbk', function ($query) {
      $query->where('unit_kerja_id', auth()->user()->unit_kerja_id);
    })->get();

    if (auth()->user()->hasRole('Admin Kepegawaian')) {
      // $ajuans = Ajuan::where('jenis', 'anjab')->whereHas('abk')->get();
      $ajuans = Ajuan::where('jenis', 'anjab')->whereHas('abk')->get();
    }

    return view('abk.ajuans', compact('title', 'ajuans'));
  }

  public function createAjuan()
  {
    return view('abk.buat-ajuan', [
      'title' => 'Buat Ajuan ABK',
      'jabatans' => JabatanDiajukan::all()
    ]);
  }

  public function storeAjuan(Ajuan $ajuan)
  {
    // get all unique unit kerja from the jabatan
    $unitKerjas = UnitKerja::all();

    // for each unit kerja, 
    // create ajuan with current year as 'tahun' and abk as 'jenis'
    foreach ($unitKerjas as $unitKerja) {
      $abk = Ajuan::create([
        'tahun' => now()->year,
        'jenis' => 'abk'
      ]);

      // also create instance of abk_anjab to map which ones are the abk for an anjab
      AbkAnjab::create([
        'abk_id' => $abk->id,
        'anjab_id' => $ajuan->id
      ]);

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

    return view('abk.jabatan.show', compact('title', 'anjab', 'abk', 'jabatan'));
  }

  public function editJabatan(Ajuan $anjab, Ajuan $abk, JabatanDiajukan $jabatan)
  {
    $title = 'Edit Informasi ABK';
    $uraians = $jabatan->uraianTugas;

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

    if (in_array($unit_kerja->unsur->nama, [
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
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Operator Unit Kerja')->first()->id,
        'is_approved' => true
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Manajer Unit Kerja')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Kepala Unit Kerja')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
        'is_approved' => false
      ]);
    }

    if ($unit_kerja->unsur->nama == 'Fakultas/Sekolah') {
      // create roles that can verify the ajuan
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Operator Unit Kerja')->first()->id,
        'is_approved' => true
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Manajer Tata Usaha')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Wakil Dekan 2')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
        'is_approved' => false
      ]);
      RoleVerifikasi::create([
        'ajuan_id' => $ajuan->id,
        'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
        'is_approved' => false
      ]);
    }

    return redirect()->route('abk.ajuan.show', ['ajuan' => $ajuan])->with('success', 'Ajuan ABK berhasil disimpan');
  }
}
