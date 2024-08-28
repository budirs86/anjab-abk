<?php

namespace App\Http\Controllers;

use App\Models\JabatanTugasTambahan;
use App\Models\JenisJabatan;
use App\Models\Unsur;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    // Controller for tugas tambahan start
    public function tugasTambahanIndex()
    {
        $title = 'Dashboard Admin';
        $tutams = JabatanTugasTambahan::all();

        return view('admin.tugas-tambahan.index', compact('title', 'tutams'));
    }

    public function tugasTambahanCreate()
    {
        $title = 'Tambah Tugas Tambahan';
        $unsurs = Unsur::all();
        $jenisJabatans = JenisJabatan::all();

        return view('admin.tugas-tambahan.create', compact('title', 'unsurs', 'jenisJabatans'));
    }

    public function tugasTambahanStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|min:4|max:255',
            'kode' => 'required|min:1|max:255',
            'unsur_id' => 'required',
            'jenis_jabatan_id' => 'required',
        ]);
        
        JabatanTugasTambahan::create([
            'nama' => $validated['nama'],
            'unsur_id' => $validated['unsur_id'],
            'jenis_jabatan_id' => $validated['jenis_jabatan_id'],
            'kode' => $validated['kode'],
        ]);

        return redirect()->route('admin.tugas-tambahan.index')->with('success', 'Tugas Tambahan ' . $validated['nama'] . ' berhasil ditambahkan');
    }

