<?php

use App\Http\Controllers\AnalisisJabatanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home',[
        'title' => 'Dashboard'
    ]);
})->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::resource('/anjab/data-jabatan/', JabatanController::class)->name('anjab.data-jabatan.index','index')->middleware('auth');
Route::resource('/anjab/analisis-jabatan/', AnalisisJabatanController::class)->middleware('auth');

Route::get('/anjab/ajuan/create',function() {
    return view('anjab.buat-ajuan',[
        'title' => ''
    ]);
})->name('anjab.buat-ajuan')->middleware('auth');

Route::get('/petajabatan', function() {

    $jabatans = Jabatan::tree()->get()->toTree();
    // dd($jabatans);
    return view("anjab.petajabatan.petajabatan",[
        'title' => "Peta Jabatan",
        'jabatans' => $jabatans
    ]);
})->middleware('auth');

Route::view('anjab/ajuans','anjab.ajuans',[
    'title' => 'Ajuan Jabatan'
])->name('anjab.ajuans');

Route::get('/anjab/ajuan/{id}',function($id) {
    $jabatans = Jabatan::tree()->get()->toTree();

    return view('anjab.ajuan',[
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => false
    ]);
})->name('anjab.ajuan');
Route::get('/anjab/ajuan/{id}/edit',function($id) {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $jabatans = Jabatan::all();

    return view('anjab.ajuan',[
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => true
    ]);
});

Route::get('abk/ajuan/create',function() {
    return view('abk.buat-ajuan',
    [
        'title' => 'Buat Ajuan Baru',
        'jabatans' => Jabatan::tree()->get()->toTree()  
    ]);
});
