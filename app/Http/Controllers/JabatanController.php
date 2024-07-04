<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJabatanRequest;
use App\Models\Eselon;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Jabatan';
        $jabatans = Jabatan::all();
        $jenisJabatan = JenisJabatan::all();
        $eselon = Eselon::all();
        $golongan = Golongan::all();
        $unitKerjas = UnitKerja::all();
        $buttons = ['tambah-jabatan-bawahan', 'ubah-informasi-jabatan'];

        return view('anjab.jabatan', compact('title', 'jabatans', 'jenisJabatan', 'eselon', 'golongan', 'unitKerjas','buttons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'eselon' => Eselon::all(),
            'golongan' => Golongan::all()
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
