<?php

use Carbon\Unit;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use App\Models\BakatKerja;
use App\Models\UpayaFisik;
use App\Models\JenisJabatan;
use GuzzleHttp\Psr7\Request;
use App\Models\TemperamenKerja;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbkController;
use App\Http\Controllers\AjuanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AnalisisJabatanController;
use App\Http\Controllers\KualifikasiController;
use App\Models\FungsiPekerjaan;

Route::get('/', function () {
    return view('home',[
        'title' => 'Dashboard'
    ]);
})->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/anjab/ajuan', [AjuanController::class, 'anjabIndex'])->name('anjab.ajuan.index')->middleware('auth');
Route::get('/anjab/ajuan/create', [AjuanController::class, 'anjabCreate'])->name('anjab.ajuan.create')->middleware('auth');
Route::post('/anjab/ajuan/store/', [AjuanController::class, 'anjabStore'])->name('anjab.ajuan.store')->middleware('auth');

Route::get('/anjab/jabatan/{jabatan:id}', [JabatanController::class, 'show'])->name('anjab.jabatan.show')->middleware('auth');
Route::get('/anjab/jabatan/{jabatan:id}/edit', [JabatanController::class, 'edit'])->name('anjab.jabatan.edit')->middleware('auth');
Route::get('/anjab/jabatan/{jabatan:id}/edit/1', [JabatanController::class, 'edit1'])->name('anjab.jabatan.edit.1')->middleware('auth');
Route::put('/anjab/jabatan/{jabatan:id}/update', [JabatanController::class, 'update'])->name('anjab.jabatan.update')->middleware('auth');
Route::post('/anjab/jabatan/{jabatan:id}/pendidikan/store', [KualifikasiController::class, 'storePendidikan'])->name('anjab.jabatan.pendidikan.store')->middleware('auth');
Route::delete('/anjab/jabatan/{jabatan}/pendidikan/{pendidikan}/delete', [KualifikasiController::class, 'deletePendidikan'])->name('anjab.jabatan.pendidikan.delete')->middleware('auth');
Route::post('/anjab/jabatan/{jabatan:id}/pengalaman/store', [KualifikasiController::class, 'storePengalaman'])->name('anjab.jabatan.pengalaman.store')->middleware('auth');
Route::delete('/anjab/jabatan/{jabatan}/pengalaman/{pengalaman}/delete', [KualifikasiController::class, 'deletePengalaman'])->name('anjab.jabatan.pengalaman.delete')->middleware('auth');

Route::get('/petajabatan', function() {

    $jabatans = Jabatan::tree()->get()->toTree();
    // dd($jabatans);
    return view("anjab.petajabatan.petajabatan",[
        'title' => "Peta Jabatan",
        'jabatans' => $jabatans
    ]);
})->middleware('auth');

Route::get('/anjab/ajuan/{id}',function($id) {
    return view('anjab.ajuan',[
        'title' => 'Ajuan Jabatan',
        'unit_kerjas' => UnitKerja::all(),
        'jabatans' => Jabatan::all(),
        'editable' => false
    ]);
})->name('anjab.ajuan');

Route::get('/anjab/ajuan/{id}/edit',function($id) {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $jabatans = Jabatan::all();

    return view('anjab.edit',[
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => true
    ]);
});

Route::get('/anjab/ajuan/{id}/unit/{unitkerja:id}',function($id,UnitKerja $unitkerja) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('anjab.unitkerja.show',[
        'title' => 'Lihat Informasi Jabatan',
        'periode' => $id,
        'unit_kerja' => $unitkerja,
        'jabatans' => Jabatan::where('unit_kerja_id',$unitkerja->id)->get(),
        'buttons' =>[
            'lihat-informasi-jabatan'
        ],
        'editable' => false
    ]);
})->name('anjab.unitkerja.show');

// Route::get('abk/ajuans', function () {
//     return view('abk.ajuans', [
//         'title' => 'Daftar Ajuan ABK    '
//     ]);
// })->name('abk.ajuans');

// Route::get('abk/ajuan/create',function() {
//     return view('abk.buat-ajuan',
//     [
//         'title' => 'Buat Ajuan Baru',
//         'jabatans' => Jabatan::tree()->get()->toTree()  
//     ]);
// });

Route::get('abk/ajuan', [AbkController::class, 'index'])->name('abk.ajuans');
Route::get('abk/ajuan/create', [AbkController::class, 'createAjuan'])->name('abk.ajuan.create');

Route::get('abk/ajuan/data-abk', function() {
    return view('abk.abkform',[
        'title' => 'Isi Informasi ABK',
        
    ]);
})->name('abk.data-abk');

Route::get('/abk/ajuan/{id}/edit',function($id) {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $jabatans = Jabatan::all();

    return view('abk.ajuan',[
        'title' => 'Ajuan ABK',
        'jabatans' => $jabatans,
        'editable' => true,
        'abk' => true
    ]);
});

Route::get('/abk/ajuan/{id}',function($id) {
    $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.ajuan',[
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => false,
        'abk' => true
    ]);
})->name('abk.ajuan');


Route::get('/abk/ajuan/{id}/jabatan/{jabatan:id}',function($id,Jabatan $jabatan) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.jabatan.show',[
        'title' => 'Lihat Informasi ABK',
        'jabatan' => $jabatan,
        'editable' => false,
        'abk' =>     true
    ]);
})->name('abk.jabatan.show');