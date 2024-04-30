<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\JenisJabatan;
use Illuminate\Http\Request;
use App\Models\AnalisisJabatan;

class AnalisisJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('anjab.analisis-jabatan',[
        // 'request' => $request,
        'title' => 'Analisis Jabatan',
        'jabatans' => Jabatan::all(),
        'jenis_jabatan' => JenisJabatan::all(),
        'eselon' => Eselon::all(),
        'golongan' => Golongan::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('anjab/anjabform',[
            'title' => 'Form Analisis Jabatan',
            'jabatan' => Jabatan::where('id',$request->jabatan),
            'jenis_jabatan' => JenisJabatan::all(),
            'eselon' => Eselon::all(),
            'golongan' => Golongan::all()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AnalisisJabatan $analisisJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnalisisJabatan $analisisJabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnalisisJabatan $analisisJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnalisisJabatan $analisisJabatan)
    {
        //
    }
}
