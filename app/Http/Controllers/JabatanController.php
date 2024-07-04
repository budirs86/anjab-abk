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

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //return view anjabform.blade.php
        return view('jabatan.edit', [
            'title' => 'Edit Data Jabatan',
            'jabatan' => $jabatan,
            'jenis_jabatan' => JenisJabatan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
