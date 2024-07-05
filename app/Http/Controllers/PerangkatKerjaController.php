<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PerangkatKerja;
use Illuminate\Http\Request;

class PerangkatKerjaController extends Controller
{
    public function storePerangkatKerja(Jabatan $jabatan, Request $request)
    {
        PerangkatKerja::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#PerangkatKerja")->with('success', 'Data Perangkat Kerja berhasil ditambahkan');
    }
    public function deletePerangkatKerja(Jabatan $jabatan, PerangkatKerja $perangkatKerja)
    {
        $perangkatKerja->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#PerangkatKerja")->with('success', 'Data Perangkat Kerja berhasil dihapus');
    }
}
