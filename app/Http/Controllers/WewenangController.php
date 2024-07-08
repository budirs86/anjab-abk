<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Wewenang;
use Illuminate\Http\Request;

class WewenangController extends Controller
{
    public function storeWewenang(Jabatan $jabatan, Request $request)
    {
        Wewenang::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#wewenang")->with('success', 'Data Wewenang berhasil ditambahkan');
    }
    public function deleteWewenang(Jabatan $jabatan, Wewenang $wewenang)
    {
        $wewenang->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#wewenang")->with('success', 'Data Wewenang berhasil dihapus');
    }
}
