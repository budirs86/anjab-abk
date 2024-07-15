<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanJabatan;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use App\Models\Role;
use App\Models\RoleVerifikasi;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class AjuanController extends Controller
{
    public function anjabIndex()
    {
        $title = 'Ajuan Jabatan';
        $ajuans = Ajuan::where('jenis', 'anjab')->get();

        return view('anjab.ajuans', compact('title', 'ajuans'));
    }

    public function anjabCreate()
    {
        $title = 'Buat Ajuan Baru';
        $jabatans = Jabatan::orderBy('nama')->get();
        $jenisJabatan = JenisJabatan::all();
        $unitKerjas = UnitKerja::all();
        return view('anjab.buat-ajuan', compact('title', 'jabatans', 'jenisJabatan', 'unitKerjas'));
    }

    public function anjabStore(Request $request)
    {
        $ajuan = Ajuan::create([
            'tahun' => now()->year,
            'jenis' => 'anjab'
        ]);

        // After creating an ajuan, roles that can verify the ajuan are created
        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '2',
            'is_approved' => false
        ]);

        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '6',
            'is_approved' => false
        ]);

        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '7',
            'is_approved' => false
        ]);

        $jabatans = $request->input('jabatans');
        foreach ($jabatans as $jabatan_id) {
            AjuanJabatan::create([
                'ajuan_id' => Ajuan::latest()->first()->id,
                'jabatan_id' => $jabatan_id
            ]);
        }

        return redirect()->route('anjab.ajuan.index')->with('success', 'Ajuan Jabatan berhasil diajukan');
    }

    public function anjabShow(Ajuan $ajuan)
    {
        $title = 'Ajuan Jabatan';
        $jabatans = Jabatan::all();
        $unitKerjas = UnitKerja::all();
        return view('anjab.ajuan', compact('title', 'ajuan', 'jabatans', 'unitKerjas'));
    }

    public function anjabVerifikasi(Ajuan $ajuan)
    {
        // When user accepts the ajuan, verification instance is created, 
        // and is_approved in RoleVerifikasi is set to true
        Verifikasi::create([
            'ajuan_id' => $ajuan->id,
            'verificator_id' => auth()->user()->id,
            'is_approved' => true,
            'catatan' => null
        ]);
        RoleVerifikasi::where('ajuan_id', $ajuan->id)
            ->where('role_id', auth()->user()->roles->first()->id)
            ->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Verifikasi berhasil');
    }

    public function anjabRevisi(Ajuan $ajuan)
    {
        // When user rejects the ajuan, verification instance is created, 
        // and is_approved in RoleVerifikasi from the previous role is set to false
        // and is_approved in RoleVerifikasi from the current role is also set to false
        Verifikasi::create([
            'ajuan_id' => $ajuan->id,
            'verificator_id' => auth()->user()->id,
            'is_approved' => false,
            'catatan' => request('catatan')
        ]);

        $previous_verificator_id = Verifikasi::where('ajuan_id', $ajuan->id)
            ->where('is_approved', true)
            ->latest()
            ->first()
            ->verificator_id;
        $previous_verificator_role_id = User::find($previous_verificator_id)->roles->first()->id;
        RoleVerifikasi::where('ajuan_id', $ajuan->id)
            ->where('role_id', $previous_verificator_role_id)
            ->update(['is_approved' => false]);

        RoleVerifikasi::where('ajuan_id', $ajuan->id)
            ->where('role_id', auth()->user()->roles->first()->id)
            ->update(['is_approved' => false]);

        return redirect()->back()->with('success', 'Revisi berhasil');
    }
}
