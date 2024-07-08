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
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PerangkatKerjaController;
use App\Http\Controllers\TanggungJawabController;
use App\Http\Controllers\UraianTugasController;

Route::get('/', function () {
    return view('home', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth')->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::prefix('anjab')->group(function () {
    Route::prefix('ajuan')->group(function () {
        Route::get('/', [AjuanController::class, 'anjabIndex'])->name('anjab.ajuan.index')->middleware('auth');
        Route::get('/create', [AjuanController::class, 'anjabCreate'])->name('anjab.ajuan.create')->middleware('auth');
        Route::post('/store/', [AjuanController::class, 'anjabStore'])->name('anjab.ajuan.store')->middleware('auth');
    });
    Route::prefix('jabatan/{jabatan}')->group(function () {
        Route::get('/', [JabatanController::class, 'show'])->name('anjab.jabatan.show')->middleware('auth');
        Route::get('/edit', [JabatanController::class, 'edit'])->name('anjab.jabatan.edit')->middleware('auth');
        Route::get('/edit/1', [JabatanController::class, 'edit1'])->name('anjab.jabatan.edit.1')->middleware('auth');
        Route::put('/update/1', [JabatanController::class, 'update1'])->name('anjab.jabatan.update.1')->middleware('auth');
        Route::get('/edit/2', [JabatanController::class, 'edit2'])->name('anjab.jabatan.edit.2')->middleware('auth');
        Route::put('/update/2', [JabatanController::class, 'update2'])->name('anjab.jabatan.update.2')->middleware('auth');
        Route::post('/pendidikan/store', [KualifikasiController::class, 'storePendidikan'])->name('anjab.jabatan.pendidikan.store')->middleware('auth');
        Route::delete('/pendidikan/{pendidikan}/delete', [KualifikasiController::class, 'deletePendidikan'])->name('anjab.jabatan.pendidikan.delete')->middleware('auth');
        Route::post('/pengalaman/store', [KualifikasiController::class, 'storePengalaman'])->name('anjab.jabatan.pengalaman.store')->middleware('auth');
        Route::delete('/pengalaman/{pengalaman}/delete', [KualifikasiController::class, 'deletePengalaman'])->name('anjab.jabatan.pengalaman.delete')->middleware('auth');
        Route::post('/pelatihan/store', [KualifikasiController::class, 'storePelatihan'])->name('anjab.jabatan.pelatihan.store')->middleware('auth');
        Route::delete('/pelatihan/{pelatihan}/delete', [KualifikasiController::class, 'deletePelatihan'])->name('anjab.jabatan.pelatihan.delete')->middleware('auth');
        Route::post('/uraian/store', [UraianTugasController::class, 'storeUraian'])->name('anjab.jabatan.uraian.store')->middleware('auth');
        Route::delete('/uraian/{uraian}/delete', [UraianTugasController::class, 'deleteUraian'])->name('anjab.jabatan.uraian.delete')->middleware('auth');
        Route::post('/bahanKerja/store', [BahanKerjaController::class, 'storeBahanKerja'])->name('anjab.jabatan.bahanKerja.store')->middleware('auth');
        Route::delete('/bahanKerja/{bahanKerja}/delete', [BahanKerjaController::class, 'deleteBahanKerja'])->name('anjab.jabatan.bahanKerja.delete')->middleware('auth');
        Route::post('/perangkatKerja/store', [PerangkatKerjaController::class, 'storePerangkatKerja'])->name('anjab.jabatan.perangkatKerja.store')->middleware('auth');
        Route::delete('/perangkatKerja/{perangkatKerja}/delete', [PerangkatKerjaController::class, 'deletePerangkatKerja'])->name('anjab.jabatan.perangkatKerja.delete')->middleware('auth');
        Route::post('/tanggungJawab/store', [TanggungJawabController::class, 'storeTanggungJawab'])->name('anjab.jabatan.tanggungJawab.store')->middleware('auth');
        Route::delete('/tanggungJawab/{tanggungJawab}/delete', [TanggungJawabController::class, 'deleteTanggungJawab'])->name('anjab.jabatan.tanggungJawab.delete')->middleware('auth');
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
Route::get('abk/jabatan/{jabatan:id}/create', function(Jabatan $jabatan){
    return view('abk.jabatan.create',[
        'jabatan' => $jabatan,
        'title' => 'Buat Informasi Beban Kerja'
    ]);
})->name('abk.jabatan.create');

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

Route::get('/abk/ajuan/{ajuan}',function(Ajuan $ajuan) {
    $jabatans = Jabatan::all();

    return view('abk.ajuan', [
        'title' => 'Ajuan Jabatan',
        'ajuan' => $ajuan,
        'periode' => $ajuan->tahun,
        'jabatans' => $jabatans,
        'unit_kerjas' => UnitKerja::all(),
    ]);
})->name('abk.ajuan');


Route::get('/abk/ajuan/{ajuan}/unit/{unit_kerja}/jabatan/{jabatan}',function(Ajuan $ajuan,UnitKerja $unit_kerja, Jabatan $jabatan) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.jabatan.show',[

        'title' => 'Lihat Informasi ABK',
        'ajuan' => $ajuan,
        'unit_kerja' => $unit_kerja,
        'jabatan' => $jabatan,
    ]);
})->name('abk.jabatan.show');
Route::get('/abk/ajuan/{ajuan}/unit/{unit_kerja}/edit',function(Ajuan $ajuan,UnitKerja $unit_kerja) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.unitkerja.edit',[

        'title' => 'Lihat Informasi ABK',
        'ajuan' => $ajuan,
        'unit_kerja' => $unit_kerja,
        'jabatans' => Jabatan::where('unit_kerja_id',$unit_kerja->id)->get(),
    ]);
})->name('abk.unitkerja.edit');
Route::get('/abk/ajuan/{ajuan}/unit/{unit_kerja}/jabatan/{jabatan}/edit',function(Ajuan $ajuan,UnitKerja $unit_kerja, Jabatan $jabatan) {
    // $jabatans = Jabatan::tree()->get()->toTree();

    return view('abk.jabatan.edit',[

        'title' => 'Lihat Informasi ABK',
        'ajuan' => $ajuan,
        'unit_kerja' => $unit_kerja,
        'jabatan' => $jabatan,
    ]);
})->name('abk.jabatan.edit');
