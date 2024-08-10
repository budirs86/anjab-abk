<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware(Authenticate::using('sanctum'));

//jabatans
Route::apiResource('/jabatans', App\Http\Controllers\Api\JabatanController::class);

//uraian tugas
Route::apiResource('/uraian-tugas', App\Http\Controllers\Api\UraianTugasController::class);
