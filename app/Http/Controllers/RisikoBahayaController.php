<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\RisikoBahaya;
use Illuminate\Http\Request;

class RisikoBahayaController extends Controller
{
    public function storeRisikoBahaya(Jabatan $jabatan, Request $request)
    {
        RisikoBahaya::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#risiko_bahaya")->with('success', 'Data Risiko Bahaya berhasil ditambahkan');
    }
    public function deleteRisikoBahaya(Jabatan $jabatan, RisikoBahaya $risikoBahaya)
    {
        $risikoBahaya->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#risiko_bahaya")->with('success', 'Data Risiko Bahaya berhasil dihapus');
    }
}
