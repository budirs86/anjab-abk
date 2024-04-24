<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home',[
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/anjab/jabatan', function() {
    return view('anjab.jabatan',[
        'title' => 'Data Jabatan',
        'jabatans' => Jabatan::all()
    ]);
})->middleware('auth');

Route::resource('/anjab/data-jabatan/', JabatanController::class);
