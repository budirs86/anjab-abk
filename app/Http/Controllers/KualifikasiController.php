<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PendidikanFormal;
use Illuminate\Http\Request;

class KualifikasiController extends Controller
{
    public function storePendidikan(Jabatan $jabatan, Request $request) {
        PendidikanFormal::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#pendidikan_formal")->with('success', 'Data Pendidikan Formal berhasil ditambahkan');
    }

    // deletePendidikan
    public function deletePendidikan(Jabatan $jabatan, PendidikanFormal $pendidikan) {
        $pendidikan->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit#pendidikan_formal")->with('success', 'Data Pendidikan Formal berhasil dihapus');
    }
}
