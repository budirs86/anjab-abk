<?php

namespace App\Http\Controllers;

use App\Models\Unsur;
use Illuminate\Http\Request;

class AdminJabatanController extends Controller
{
    // create index function
    public function index()
    {   
        $title = 'Data Jabatan';
        $unsurs = Unsur::all();

        return view('admin.jabatan.index', compact('title', 'unsurs'));
    }
}
