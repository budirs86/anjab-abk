<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JabatanResource;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    //get all jabatans
    $jabatans = Jabatan::latest()->get();

    //return a collection of jabatans as a resource
    return new JabatanResource(true, 'List Data Jabatan', $jabatans);
  }
}
