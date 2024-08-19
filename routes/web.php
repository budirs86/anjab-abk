<?php

use App\Models\Jabatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbkController;
use App\Http\Controllers\AdminJabatanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AjuanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BahanKerjaController;
use App\Http\Controllers\KorelasiJabatanController;
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PerangkatKerjaController;
use App\Http\Controllers\RisikoBahayaController;
use App\Http\Controllers\TanggungJawabController;
use App\Http\Controllers\UraianTugasController;
use App\Http\Controllers\WewenangController;
use App\Models\Ajuan;
use App\Models\JabatanDiajukan;

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
    Route::get('/{ajuan:tahun}/{id}', [AjuanController::class, 'anjabShow'])->name('show');
    Route::get('/{tahun}/{id}/edit', [AjuanController::class, 'anjabEdit'])->name('edit');
    Route::post('/{ajuan}/update', [AjuanController::class, 'anjabUpdate'])->name('update');
    Route::get('/{ajuan:tahun}/jabatan/{jabatan}', [AjuanController::class, 'anjabShowJabatan'])->name('jabatan.show');
    Route::get('/{ajuan:tahun}/jabatan/{jabatan}/edit/1', [AjuanController::class, 'anjabEditJabatan1'])->name('jabatan.edit.1');
    Route::put('/{ajuan:tahun}/jabatan/{jabatan}/update/1', [AjuanController::class, 'anjabUpdateJabatan1'])->name('jabatan.update.1');
    Route::get('/{ajuan:tahun}/jabatan/{jabatan}/edit/2', [AjuanController::class, 'anjabEditJabatan2'])->name('jabatan.edit.2');
    Route::put('/{ajuan:tahun}/jabatan/{jabatan}/update/2', [AjuanController::class, 'anjabUpdateJabatan2'])->name('jabatan.update.2');
    Route::post('/{ajuan}/verifikasi', [AjuanController::class, 'anjabVerifikasi'])->name('verifikasi');
    Route::post('/{ajuan}/revisi', [AjuanController::class, 'anjabRevisi'])->name('revisi');
  });
  
  Route::prefix('jabatan')->name('anjab.jabatan.')->group(function () {
    Route::post('/store', [JabatanController::class, 'store'])->name('store');

    Route::prefix('/{jabatan}')->group(function () {
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
    Route::post('/korelasi-jabatan/store', [KorelasiJabatanController::class, 'storeKorelasiJabatan'])->name('korelasiJabatan.store');
    Route::delete('/korelasi-jabatan/{korelasiJabatan}/delete', [KorelasiJabatanController::class, 'deleteKorelasiJabatan'])->name('korelasiJabatan.delete');
    Route::post('/risiko-bahaya/store', [RisikoBahayaController::class, 'storeRisikoBahaya'])->name('risikoBahaya.store');
    Route::delete('/risiko-bahaya/{risikoBahaya}/delete', [RisikoBahayaController::class, 'deleteRisikoBahaya'])->name('risikoBahaya.delete');
  });
});

Route::prefix('abk/ajuan')->middleware('auth')->name('abk.')->group(function () {
  Route::get('/', [AbkController::class, 'index'])->name('ajuans');
  Route::prefix('{ajuan}')->group(function () {
    Route::get('/', [AbkController::class, 'showAjuan'])->name('ajuan.show');
    Route::post('/store', [AbkController::class, 'storeAjuan'])->name('ajuan.store');
    Route::get('/unit/{unit_kerja}', [AbkController::class, 'showUnitKerja'])->name('unitkerja.show');
    Route::get('/unit/{unit_kerja}/edit', [AbkController::class, 'editUnitKerja'])->name('unitkerja.edit');
    Route::post('/unit/{unit_kerja}/update', [AbkController::class, 'updateAjuan'])->name('ajuan.update');
    Route::get('/unit/{unit_kerja}/jabatan/{jabatan}', [AbkController::class, 'showJabatan'])->name('jabatan.show');
    Route::get('/unit/{unit_kerja}/jabatan/{jabatan}/create', [AbkController::class, 'createJabatan'])->name('jabatan.create');
    Route::get('/unit/{unit_kerja}/jabatan/{jabatan}/edit', [AbkController::class, 'editJabatan'])->name('jabatan.edit');
    Route::put('/unit/{unit_kerja}/jabatan/{jabatan}/edit/{detail_abk}/store', [AbkController::class, 'storeDetailAbk'])->name('detail_abk.store');
  });
});

Route::prefix('admin')->name('admin.')->middleware('role:superadmin')->group(function () {
  Route::get('/dashboard', function () {
    return view('admin.dashboard', [
      'title' => 'Dashboard Admin'
    ]);
  })->name('dashboard');
  Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::get('/create', [AdminUserController::class, 'create'])->name('create');
    Route::post('/store', [AdminUserController::class, 'store'])->name('store');
    Route::prefix('{user}')->group(function () {
      Route::get('/edit', [AdminUserController::class, 'edit'])->name('edit');
      Route::put('/update', [AdminUserController::class, 'update'])->name('update');
      Route::delete('/destroy', [AdminUserController::class, 'destroy'])->name('destroy');
    });
    });
  Route::prefix('jabatans')->name('jabatans.')->group(function() {
    Route::get('/',[AdminJabatanController::class, 'index'])->name('index');
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

Route::prefix('/laporan')->name('laporan.')->middleware('auth')->group(function() {
  Route::get('/', function () {
    $title = 'Laporan';
    $ajuans = Ajuan::all();

    return view('laporan.index', compact('title', 'ajuans'));
  })->name('index');

  Route::get('anjab/{tahun}/{ajuan}', function($tahun, Ajuan $ajuan) {
    $title = 'Laporan Analisis Jabatan' . $ajuan->tahun;
    $jabatans = JabatanDiajukan::where('ajuan_id', $ajuan->id)->get();

    return view('laporan.anjab', compact('title', 'ajuan', 'jabatans'));
  })->name('anjab');
});