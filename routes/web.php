<?php

use App\Http\Controllers\AnalisisJabatanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home',[
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('/anjab/data-jabatan/', JabatanController::class)->middleware('auth');
Route::resource('/anjab/analisis-jabatan/', AnalisisJabatanController::class)->middleware('auth');
