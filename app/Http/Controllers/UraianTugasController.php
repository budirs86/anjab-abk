<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\UraianTugas;
use Illuminate\Http\Request;

class UraianTugasController extends Controller
{
    public function storeUraian(Jabatan $jabatan, Request $request)
    {
        UraianTugas::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#uraian_tugas")->with('success', 'Data uraian berhasil ditambahkan');
    }
    public function deleteUraian(Jabatan $jabatan, UraianTugas $uraian)
    {
        $uraian->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#uraian_tugas")->with('success', 'Data uraian berhasil dihapus');
    }
}
