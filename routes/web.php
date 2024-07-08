<?php

use Carbon\Unit;
use App\Models\Jabatan;
use App\Models\UnitKerja;
use App\Models\BakatKerja;
use App\Models\MinatKerja;
use App\Models\UpayaFisik;
use App\Models\JenisJabatan;
use GuzzleHttp\Psr7\Request;
use App\Models\FungsiPekerjaan;
use App\Models\TemperamenKerja;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbkController;
use App\Http\Controllers\AjuanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AnalisisJabatanController;
use App\Http\Controllers\BahanKerjaController;
use App\Http\Controllers\KorelasiJabatanController;
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PerangkatKerjaController;
use App\Http\Controllers\TanggungJawabController;
use App\Http\Controllers\UraianTugasController;
use App\Http\Controllers\WewenangController;

Route::get('/', function () {
    return view('home', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::prefix('anjab')->middleware('auth')->group(function () {
    Route::prefix('ajuan')->name('anjab.ajuan.')->group(function () {
        Route::get('/', [AjuanController::class, 'anjabIndex'])->name('index');
        Route::get('/create', [AjuanController::class, 'anjabCreate'])->name('create');
        Route::post('/store', [AjuanController::class, 'anjabStore'])->name('store');
    });
    Route::prefix('jabatan/{jabatan}')->name('anjab.jabatan.')->group(function () {
        Route::get('/', [JabatanController::class, 'show'])->name('show');
        Route::get('/edit', [JabatanController::class, 'edit'])->name('edit');
        Route::get('/edit/1', [JabatanController::class, 'edit1'])->name('edit.1');
        Route::put('/update/1', [JabatanController::class, 'update1'])->name('update.1');
        Route::get('/edit/2', [JabatanController::class, 'edit2'])->name('edit.2');
        Route::put('/update/2', [JabatanController::class, 'update2'])->name('update.2');
        Route::post('/pendidikan/store', [KualifikasiController::class, 'storePendidikan'])->name('pendidikan.store');
        Route::delete('/pendidikan/{pendidikan}/delete', [KualifikasiController::class, 'deletePendidikan'])->name('pendidikan.delete');
        Route::post('/pengalaman/store', [KualifikasiController::class, 'storePengalaman'])->name('pengalaman.store');
        Route::delete('/pengalaman/{pengalaman}/delete', [KualifikasiController::class, 'deletePengalaman'])->name('pengalaman.delete');
        Route::post('/pelatihan/store', [KualifikasiController::class, 'storePelatihan'])->name('pelatihan.store');
        Route::delete('/pelatihan/{pelatihan}/delete', [KualifikasiController::class, 'deletePelatihan'])->name('pelatihan.delete');
        Route::post('/uraian/store', [UraianTugasController::class, 'storeUraian'])->name('uraian.store');
        Route::delete('/uraian/{uraian}/delete', [UraianTugasController::class, 'deleteUraian'])->name('uraian.delete');
        Route::post('/bahan-kerja/store', [BahanKerjaController::class, 'storeBahanKerja'])->name('bahanKerja.store');
        Route::delete('/bahan-kerja/{bahanKerja}/delete', [BahanKerjaController::class, 'deleteBahanKerja'])->name('bahanKerja.delete');
        Route::post('/perangkat-kerja/store', [PerangkatKerjaController::class, 'storePerangkatKerja'])->name('perangkatKerja.store');
        Route::delete('/perangkat-kerja/{perangkatKerja}/delete', [PerangkatKerjaController::class, 'deletePerangkatKerja'])->name('perangkatKerja.delete');
        Route::post('/tanggung-jawab/store', [TanggungJawabController::class, 'storeTanggungJawab'])->name('tanggungJawab.store');
        Route::delete('/tanggung-jawab/{tanggungJawab}/delete', [TanggungJawabController::class, 'deleteTanggungJawab'])->name('tanggungJawab.delete');
        Route::post('/wewenang/store', [WewenangController::class, 'storeWewenang'])->name('wewenang.store');
        Route::delete('/wewenang/{wewenang}/delete', [WewenangController::class, 'deleteWewenang'])->name('wewenang.delete');
        Route::post('/korelasi-jabatan/store', [KorelasiJabatanController::class, 'storeKorelasiJabatan'])->name('KorelasiJabatan.store');
        Route::delete('/korelasi-jabatan/{KorelasiJabatan}/delete', [KorelasiJabatanController::class, 'deleteKorelasiJabatan'])->name('KorelasiJabatan.delete');
    });
});


Route::get('/petajabatan', function () {

    $jabatans = Jabatan::tree()->get()->toTree();
    // dd($jabatans);
    return view("anjab.petajabatan.petajabatan", [
        'title' => "Peta Jabatan",
        'jabatans' => $jabatans
    ]);
})->middleware('auth');

Route::get('/anjab/ajuan/{id}', function ($id) {
    return view('anjab.ajuan', [
        'title' => 'Ajuan Jabatan',
        'unit_kerjas' => UnitKerja::all(),
        'jabatans' => Jabatan::all(),
        'editable' => false
    ]);
})->name('anjab.ajuan');

Route::get('/anjab/ajuan/{id}/edit', function ($id) {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $jabatans = Jabatan::all();

    return view('anjab.edit', [
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => true
    ]);
});

Route::get('/anjab/ajuan/{id}/unit/{unitkerja:id}', function ($id, UnitKerja $unitkerja) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('anjab.unitkerja.show', [
        'title' => 'Lihat Informasi Jabatan',
        'periode' => $id,
        'unit_kerja' => $unitkerja,
        'jabatans' => Jabatan::where('unit_kerja_id', $unitkerja->id)->get(),
        'buttons' => [
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

Route::get('abk/ajuan/data-abk', function () {
    return view('abk.abkform', [
        'title' => 'Isi Informasi ABK',

    ]);
})->name('abk.data-abk');

Route::get('/abk/ajuan/{id}/edit', function ($id) {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $jabatans = Jabatan::all();

    return view('abk.ajuan', [
        'title' => 'Ajuan ABK',
        'jabatans' => $jabatans,
        'editable' => true,
        'abk' => true
    ]);
});

Route::get('/abk/ajuan/{id}', function ($id) {
    $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.ajuan', [
        'title' => 'Ajuan Jabatan',
        'jabatans' => $jabatans,
        'editable' => false,
        'abk' => true
    ]);
})->name('abk.ajuan');


Route::get('/abk/ajuan/{id}/jabatan/{jabatan:id}', function ($id, Jabatan $jabatan) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.jabatan.show', [
        'title' => 'Lihat Informasi ABK',
        'jabatan' => $jabatan,
        'editable' => false,
        'abk' =>     true
    ]);
})->name('abk.jabatan.show');
