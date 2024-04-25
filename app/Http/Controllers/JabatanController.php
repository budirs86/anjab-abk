<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        // $validatedData = request()->validate([
        //     'nama_jabatan' => 'required',
        //     'unit_kerja' => 'required'
        // ]);
        // ddd();

        // Jabatan::create($validatedData);
        
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required',
            'unit_kerja' => 'required'
        ]);
        
        if($validator->fails()) {
            
            // // Halaman ke-refresh
            return redirect('/anjab/jabatan')->withErrors($validator)->withInput();
            
            // return response()->json([$validator->errors()->getMessages()],422);
        }
        
        $validatedData = $validator->validated();
        
        Jabatan::create($validatedData);
        

        return back()->with('success', 'Data Jabatan berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
