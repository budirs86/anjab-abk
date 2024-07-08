<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\TanggungJawab;
use Illuminate\Http\Request;

class TanggungJawabController extends Controller
{
    public function storeTanggungJawab(Jabatan $jabatan, Request $request)
    {
        TanggungJawab::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#tanggung_jawab")->with('success', 'Data Tanggung Jawab berhasil ditambahkan');
    }
    public function deleteTanggungJawab(Jabatan $jabatan, TanggungJawab $tanggungJawab)
    {
        $tanggungJawab->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#tanggung_jawab")->with('success', 'Data Tanggung Jawab berhasil dihapus');
    }
}
