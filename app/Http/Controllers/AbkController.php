<?php

namespace App\Http\Controllers;

use App\Models\AbkAnjab;
use App\Models\Ajuan;
use App\Models\AjuanUnitKerja;
use App\Models\DetailAbk;
use App\Models\Jabatan;
use App\Models\JabatanDiajukan;
use App\Models\Role;
use App\Models\UnitKerja;
use App\Models\UraianTugas;
use App\Models\UraianTugasDiajukan;
use Illuminate\Http\Request;

class AbkController extends Controller
{
  public function index()
  {
    $title = 'Daftar Ajuan ABK';
    // display ajuan anjab that has been approved by wakil rektor 2
    $wakilRektorRoleId = Role::where('name', 'Wakil Rektor 2')->first()->id;
    $ajuans = Ajuan::where('jenis', 'anjab')->whereHas('role_verifikasi', function ($query) use ($wakilRektorRoleId) {
      $query->where('role_id', $wakilRektorRoleId)->where('is_approved', true);
    })->get();

    return view('abk.ajuans', compact('title', 'ajuans'));
  }

  public function createAjuan()
  {
    return view('abk.buat-ajuan', [
      'title' => 'Buat Ajuan ABK',
      'jabatans' => JabatanDiajukan::all()
    ]);
  }

  public function storeAjuan(Ajuan $ajuan)
  {
    // get all unique unit kerja from the jabatan
    $unitKerjas = UnitKerja::all();

    // for each unit kerja, 
    // create ajuan with current year as 'tahun' and abk as 'jenis'
    foreach ($unitKerjas as $unitKerja) {
      $abk = Ajuan::create([
        'tahun' => now()->year,
        'jenis' => 'abk'
      ]);

      // also create instance of abk_anjab to map which ones are the abk for an anjab
      AbkAnjab::create([
        'abk_id' => $abk->id,
        'anjab_id' => $ajuan->id
      ]);

      // also create detail ABK for each ajuan in the unit kerja with the ajuan id and unit kerja id
      $jabatanUnitKerjas = $unitKerja->jabatansWithin();
      foreach ($jabatanUnitKerjas as $jabatanUnitKerja) {
        DetailAbk::create([
          'ajuan_id' => $abk->id,
          'unit_kerja_id' => $unitKerja->id,
          'jabatan_id' => $jabatanUnitKerja->jabatan_diajukan_id,
          'uraian_tugas' => UraianTugasDiajukan::where('jabatan_diajukan_id', $jabatanUnitKerja->jabatan_diajukan_id)->get()
        ]);
      }
    }

    return redirect()->route('abk.ajuans');
  }

  public function showAjuan(Ajuan $ajuan)
  {
    $title = 'Ajuan ABK';
    $ajuan = $ajuan;
    $periode = $ajuan->tahun;
    // if the logged in user has role "Admin Kepegawaian", display all unit kerja
    // else, display only the unit kerja of the logged in user
    if (auth()->user()->hasRole('Admin Kepegawaian')) {
      $unit_kerjas = UnitKerja::all();
    } else if (auth()->user()->hasRole('Operator Unit Kerja')) {
      $unit_kerjas = UnitKerja::where('id', auth()->user()->unit_kerja_id)->get();
    }

    return view('abk.ajuan', compact('title', 'ajuan', 'periode', 'unit_kerjas'));
  }

  public function showUnitKerja(Ajuan $ajuan, UnitKerja $unit_kerja)
  {
    $title = 'Lihat Informasi ABK';
    $ajuan = $ajuan;
    $unit_kerja = $unit_kerja;
    $jabatans = JabatanDiajukan::where('unit_kerja_id', $unit_kerja->id)->get();

    return view('abk.unitkerja.show', compact('title', 'ajuan', 'unit_kerja', 'jabatans'));
  }

  public function editUnitKerja(Ajuan $ajuan, UnitKerja $unit_kerja)
  {
    $title = 'Edit Informasi ABK';
    $ajuan = $ajuan;
    $unit_kerja = $unit_kerja;
    $jabatans = JabatanDiajukan::where('unit_kerja_id', $unit_kerja->id)->get();

    return view('abk.unitkerja.edit', compact('title', 'ajuan', 'unit_kerja', 'jabatans'));
  }

  public function createJabatan(JabatanDiajukan $jabatan)
  {
    return view('abk.jabatan.create', [
      'jabatan' => $jabatan,
      'title' => 'Buat Informasi Beban Kerja'
    ]);
  }

  public function showJabatan(Ajuan $ajuan, UnitKerja $unit_kerja, JabatanDiajukan $jabatan)
  {
    $title = 'Lihat Informasi ABK';
    $ajuan = $ajuan;
    $unit_kerja = $unit_kerja;
    $jabatan = $jabatan;

    return view('abk.jabatan.show', compact('title', 'ajuan', 'unit_kerja', 'jabatan'));
  }

  public function editJabatan(Ajuan $ajuan, UnitKerja $unit_kerja, JabatanDiajukan $jabatan)
  {
    $title = 'Edit Informasi ABK';
    $uraians = $jabatan->uraianTugas;

    return view('abk.jabatan.edit', compact('title', 'ajuan', 'unit_kerja', 'jabatan', 'uraians'));
  }
}
