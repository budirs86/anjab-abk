<?php

namespace App\Http\Controllers;

use App\Http\Resources\JabatanDiajukanAjuanResource;
use App\Models\Ajuan;
use App\Models\DetailAbk;
use App\Models\JabatanDiajukan;
use App\Models\User;
use Illuminate\Http\Request;

class JabatanDiajukanAjuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        $jabatans = JabatanDiajukan::where('ajuan_id', request('ajuan'))->pluck('nama');
        return new JabatanDiajukanAjuanResource($jabatans);
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
    public function show(JabatanDiajukan $jabatanDiajukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JabatanDiajukan $jabatanDiajukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JabatanDiajukan $jabatanDiajukan)
    {
        //
    }
}
