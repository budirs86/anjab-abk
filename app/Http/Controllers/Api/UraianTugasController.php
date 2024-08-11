<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UraianTugasResource;
use App\Models\UraianTugas;
use Illuminate\Http\Request;

class UraianTugasController extends Controller
{
  /**
   * index
   *
   * @return void
   */
  public function index()
  {
    //get all uraian tugas
    $uraians = UraianTugas::latest()->get();

    //return a collection of uraian tugas as a resource
    return new UraianTugasResource(true, 'List Data Uraian Tugas', $uraians);
  }
}
