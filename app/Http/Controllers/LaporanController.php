<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\JabatanDiajukan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'Laporan';
        $ajuans = Ajuan::all();

        return view('laporan.index', compact('title', 'ajuans'));
    }

    public function showAnjab($tahun, Ajuan $anjab)
    {
        $title = 'Laporan Analisis Jabatan' . $anjab->tahun;
        $jabatans = JabatanDiajukan::where('ajuan_id', $anjab->id)->get();

        return view('laporan.anjab', compact('title', 'anjab', 'jabatans'));
    }
}
