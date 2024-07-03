<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanJabatan;
use App\Models\Eselon;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class AjuanController extends Controller
{
    public function anjabIndex()
    {
        $title = 'Ajuan Jabatan';

        return view('anjab/ajuans', compact('title'));
    }

    public function anjabCreate()
    {
        $title = 'Buat Ajuan Baru';
        $jabatans = Jabatan::tree()->get()->toTree();
        $jenisJabatan = JenisJabatan::all();
        $eselon = Eselon::all();
        $golongan = Golongan::all();
        $unitKerjas = UnitKerja::all();
        $buttons = ['tambah-jabatan-bawahan', 'ubah-informasi-jabatan'];
        return view('anjab.buat-ajuan', compact('title', 'jabatans', 'jenisJabatan', 'eselon', 'golongan', 'unitKerjas', 'buttons'));
    }

    public function anjabStore($jabatans)
    {
        Ajuan::create([
            'tahun' => now()->year,
            'status' => 'diajukan',
            'jenis' => 'anjab'
        ]);

        foreach ($jabatans as $jabatan) {
            AjuanJabatan::create([
                'ajuan_id' => Ajuan::latest()->first()->id,
                'jabatan_id' => $jabatan->id
            ]);
        }
    }
}
