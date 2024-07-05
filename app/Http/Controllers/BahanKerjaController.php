<?php

namespace App\Http\Controllers;

use App\Models\BahanKerja;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class BahanKerjaController extends Controller
{
    public function storeBahanKerja(Jabatan $jabatan, Request $request)
    {
        BahanKerja::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#BahanKerja")->with('success', 'Data Bahan Kerja berhasil ditambahkan');
    }
    public function deleteBahanKerja(Jabatan $jabatan, BahanKerja $bahanKerja)
    {
        $bahanKerja->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#BahanKerja")->with('success', 'Data Bahan Kerja berhasil dihapus');
    }
}
