<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJabatanRequest;
use App\Models\BakatKerja;
use App\Models\FungsiPekerjaan;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use App\Models\TemperamenKerja;
use App\Models\UnitKerja;
use App\Models\UpayaFisik;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $title = 'Data Jabatan';
        $jabatans = Jabatan::all();
        $jenisJabatan = JenisJabatan::all();
        $unitKerjas = UnitKerja::all();
        $buttons = ['tambah-jabatan-bawahan', 'ubah-informasi-jabatan'];

        return view('anjab.jabatan', compact('title', 'jabatans', 'jenisJabatan', 'unitKerjas', 'buttons'));
    }

    public function store(CreateJabatanRequest $request)
    {
        $validatedData = $request->validated();

        Jabatan::create($validatedData);


        return back()->with('success', 'Data Jabatan berhasil Ditambahkan');
    }

    public function edit(Jabatan $jabatan)
    {
        $title = 'Form Informasi Jabatan';
        $bakat_kerjas = BakatKerja::all();
        $unit_kerjas = UnitKerja::all();
        $jenis_jabatan = JenisJabatan::all();
        $temperamens = TemperamenKerja::all();
        $upaya_fisiks = UpayaFisik::all();
        $fungsi_pekerjaans = FungsiPekerjaan::all();

        return view('anjab.jabatan.edit', compact('title', 'jabatan', 'bakat_kerjas', 'unit_kerjas', 'jenis_jabatan', 'temperamens', 'upaya_fisiks', 'fungsi_pekerjaans'));
    }
}
