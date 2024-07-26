<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanUnitKerja;
use App\Models\Jabatan;
use App\Models\JabatanDiajukan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class AbkController extends Controller
{
  public function index()
  {

    return view('abk.ajuans', [
      'title' => 'Daftar Ajuan ABK',
      'ajuans' => Ajuan::where('jenis', 'abk')->get()
    ]);
  }

  public function createAjuan()
  {
    return view('abk.buat-ajuan', [
      'title' => 'Buat Ajuan ABK',
      'jabatans' => Jabatan::all()
    ]);
  }

  public function storeAjuan(Ajuan $ajuan)
  {
    // get all jabatan from the anjab
    $jabatans = JabatanDiajukan::where('ajuan_id', $ajuan->id)->get();
    // get all unique unit kerja from the jabatan
    $unitKerjas = $jabatans->map(function ($jabatan) {
      return $jabatan->unitKerja;
    })->unique();
    // for each unit kerja on the anjab, 
    // create ajuan with current year as 'tahun' and abk as 'jenis'
    foreach ($unitKerjas as $unitKerja) {
      $ajuan = Ajuan::create([
        'tahun' => now()->year,
        'jenis' => 'abk'
      ]);

      // also create ajuan unit kerja with the ajuan id and unit kerja id
      AjuanUnitKerja::create([
        'ajuan_id' => $ajuan->id,
        'unit_kerja_id' => $unitKerja->id
      ]);
    }

    return redirect()->route('abk.ajuans');
  }

  public function showAjuan(Ajuan $ajuan)
  {
    $jabatans = Jabatan::all();
    $title = 'Ajuan ABK';
    $ajuan = $ajuan;
    $periode = $ajuan->tahun;
    $jabatans = $jabatans;
    $unit_kerjas = UnitKerja::all();
  public function showUnitKerja(Ajuan $ajuan, UnitKerja $unit_kerja)
  {
    $title = 'Lihat Informasi ABK';
    $ajuan = $ajuan;
    $unit_kerja = $unit_kerja;
    $jabatans = Jabatan::where('unit_kerja_id', $unit_kerja->id)->get();

    return view('abk.unitkerja.show', compact('title', 'ajuan', 'unit_kerja', 'jabatans'));
  }
}
