<?php

namespace App\Http\Controllers;

use App\Models\KorelasiJabatan;
use Illuminate\Http\Request;

class KorelasiJabatanController extends Controller
{
    public function storeKorelasiJabatan(Request $request)
    {
        KorelasiJabatan::create($request->all());

        return redirect()->to("/anjab/jabatan/$request->jabatan_id/edit/3#korelasi")->with('success', 'Data Korelasi Jabatan berhasil ditambahkan');
    }

    public function deleteKorelasiJabatan(KorelasiJabatan $korelasiJabatan)
    {
        $korelasiJabatan->delete();

        return redirect()->to("/anjab/jabatan/$korelasiJabatan->jabatan_id/edit/3#korelasi")->with('success', 'Data Korelasi Jabatan berhasil dihapus');
    }
}
