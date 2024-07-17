<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanJabatan;
use App\Models\BakatKerja;
use App\Models\FungsiPekerjaan;
use App\Models\Jabatan;
use App\Models\JabatanDiajukan;
use App\Models\JenisJabatan;
use App\Models\KondisiLingkunganKerja;
use App\Models\MinatKerja;
use App\Models\Role;
use App\Models\RoleVerifikasi;
use App\Models\SyaratBakat;
use App\Models\SyaratFungsi;
use App\Models\SyaratJabatan;
use App\Models\SyaratMinat;
use App\Models\SyaratTemperamen;
use App\Models\SyaratUpaya;
use App\Models\TemperamenKerja;
use App\Models\UnitKerja;
use App\Models\UpayaFisik;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class AjuanController extends Controller
{
  public function anjabIndex()
  {
    $title = 'Ajuan Jabatan';
    $ajuans = Ajuan::where('jenis', 'anjab')->get();

    return view('anjab.ajuans', compact('title', 'ajuans'));
  }

  public function anjabCreate()
  {
    $title = 'Buat Ajuan Baru';
    $jenisJabatan = JenisJabatan::all();
    $unitKerjas = UnitKerja::all();

    // check if there is an ajuan draft
    // if there is no draft, get data from 'jabatan' table and put them in 'jabatan_diajukan' table
    // if there is a draft already, simply get data from 'jabatan_diajukan' table
    if (!JabatanDiajukan::is_draft_exist()) {
      foreach (Jabatan::all() as $jabatan) {
        JabatanDiajukan::create([
          // 'ajuan_id' => null,
          'parent_id' => $jabatan->parent_id,
          'jenis_jabatan_id' => $jabatan->jenis_jabatan_id,
          'unit_kerja_id' => $jabatan->unit_kerja_id,
          'nama' => $jabatan->nama,
          'kode' => $jabatan->kode,
          'kelas_jabatan' => $jabatan->kelas_jabatan,
          'ikhtisar' => $jabatan->ikhtisar,
          'prestasi' => $jabatan->prestasi,
          'tanggung_jawab' => $jabatan->tanggung_jawab
        ]);
      }
    }
    $jabatans = JabatanDiajukan::where('ajuan_id', null)->get();

    return view('anjab.buat-ajuan', compact('title', 'jabatans', 'jenisJabatan', 'unitKerjas'));
  }

  public function anjabStore()
  {
    $ajuan = Ajuan::create([
      'tahun' => now()->year,
      'jenis' => 'anjab'
    ]);

    // After creating an ajuan, roles that can verify the ajuan are created
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => '2',
      'is_approved' => false
    ]);
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => '6',
      'is_approved' => false
    ]);
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => '7',
      'is_approved' => false
    ]);

    $jabatans = JabatanDiajukan::where('ajuan_id', null)->get();
    foreach ($jabatans as $jabatan) {
      $jabatan->update(['ajuan_id' => $ajuan->id]);
    }

    return redirect()->route('anjab.ajuan.index')->with('success', 'Ajuan Jabatan berhasil diajukan');
  }

  public function anjabShow(Ajuan $ajuan)
  {
    $title = 'Ajuan Jabatan';
    $jabatans = Jabatan::all();
    $unitKerjas = UnitKerja::all();
    return view('anjab.ajuan', compact('title', 'ajuan', 'jabatans', 'unitKerjas'));
  }

  public function anjabEdit(Ajuan $ajuan)
  {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $title = 'Ajuan Jabatan';
    $jabatans = Jabatan::all();
    $editable = true;
    return view('anjab.ajuan.edit', compact('title', 'ajuan', 'jabatans', 'editable'));
  }

  public function anjabShowJabatan(Ajuan $ajuan, Jabatan $jabatan)
  {
    $title = 'Lihat Informasi Jabatan';
    $bakat_kerjas = BakatKerja::all();
    $unit_kerjas = UnitKerja::all();
    $jenis_jabatan = JenisJabatan::all();
    $temperamens = TemperamenKerja::all();
    $upaya_fisiks = UpayaFisik::all();
    $fungsi_pekerjaans = FungsiPekerjaan::all();
    return view('anjab.jabatan.show', compact(
      'ajuan',
      'jabatan',
      'title',
      'bakat_kerjas',
      'unit_kerjas',
      'jenis_jabatan',
      'temperamens',
      'upaya_fisiks',
      'fungsi_pekerjaans'
    ));
  }

  public function anjabEditJabatan1(Ajuan $ajuan, Jabatan $jabatan)
  {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $title = 'Form Informasi Jabatan';
    $bakat_kerjas = BakatKerja::all();
    $unit_kerjas = UnitKerja::all();
    $jenis_jabatan = JenisJabatan::all();
    $temperamens = TemperamenKerja::all();
    $upaya_fisiks = UpayaFisik::all();
    $fungsi_pekerjaans = FungsiPekerjaan::all();

    return view('anjab.jabatan.edit.step-1', compact(
      'ajuan',
      'jabatan',
      'title',
      'bakat_kerjas',
      'unit_kerjas',
      'jenis_jabatan',
      'temperamens',
      'upaya_fisiks',
      'fungsi_pekerjaans'
    ));
  }

  public function anjabUpdateJabatan1(Request $request, Ajuan $ajuan, Jabatan $jabatan)
  {
    $jabatan->update($request->all());

    return redirect()->route('anjab.ajuan.jabatan.edit.2', ['ajuan' => $ajuan->tahun, 'jabatan' => $jabatan])->with('success', 'Data Jabatan berhasil Diubah');
  }

  public function anjabEditJabatan2(Ajuan $ajuan, Jabatan $jabatan)
  {
    $title = 'Form Informasi Jabatan';
    $jabatans = Jabatan::orderBy('nama')->get();
    $bakatKerja = BakatKerja::all();
    $unitKerja = UnitKerja::all();
    $jenisJabatan = JenisJabatan::all();
    $temperamen = TemperamenKerja::all();
    $upayaFisik = UpayaFisik::all();
    $fungsiPekerjaan = FungsiPekerjaan::all();
    $minatKerja = MinatKerja::all();


    // get necessary data for checkboxes
    // checkboxes are checked if the data is found in the database
    $checkedBakatKerja = SyaratBakat::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('bakat_kerja_id')->toArray();
    $checkedTemperamenKerja = SyaratTemperamen::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('temperamen_kerja_id')->toArray();
    $checkedMinatKerja = SyaratMinat::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('minat_kerja_id')->toArray();
    $checkedUpayaFisik = SyaratUpaya::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('upaya_fisik_id')->toArray();
    $checkedFungsiPekerjaan = SyaratFungsi::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('fungsi_pekerjaan_id')->toArray();

    return view('anjab/jabatan/edit/step-2', compact(
      'ajuan',
      'title',
      'jabatans',
      'jabatan',
      'bakatKerja',
      'unitKerja',
      'jenisJabatan',
      'temperamen',
      'upayaFisik',
      'fungsiPekerjaan',
      'minatKerja',
      'checkedBakatKerja',
      'checkedTemperamenKerja',
      'checkedMinatKerja',
      'checkedUpayaFisik',
      'checkedFungsiPekerjaan',
    ));
  }

  public function anjabUpdateJabatan2(Request $request, Ajuan $ajuan, Jabatan $jabatan)
  {
    // loop through $request->input('kondisiLingkunganKerja') and put them all inside $kondisi
    $kondisi = [];
    foreach ($request->input('kondisiLingkunganKerja') as $key => $value) {
      $kondisi[$key] = $value;
    }
    $kondisiLingkunganKerja = KondisiLingkunganKerja::where('jabatan_id', $jabatan->id)->first();
    $kondisiLingkunganKerja->update($kondisi);

    $syaratJabatan = SyaratJabatan::where('jabatan_id', $jabatan->id)->first();
    $syaratJabatan->update($request->all());

    // UPDATING SYARAT BAKAT
    // delete SyaratBakat instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('bakatKerja') and create new SyaratBakat instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratBakat::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $bakatKerja = $request->input('bakatKerja');
    if ($bakatKerja) {
      foreach ($bakatKerja as $bakatKerjaId) {
        SyaratBakat::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'bakat_kerja_id' => $bakatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT TEMPERAMEN
    // delete SyaratTemperamen instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('temperamenKerja') and create new SyaratTemperamen instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratTemperamen::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $temperamenKerja = $request->input('temperamenKerja');
    if ($temperamenKerja) {
      foreach ($temperamenKerja as $temperamenKerjaId) {
        SyaratTemperamen::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'temperamen_kerja_id' => $temperamenKerjaId
        ]);
      }
    }

    // UPDATING SYARAT MINAT
    // delete MinatKerja instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('minatKerja') and create new MinatKerja instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratMinat::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $minatKerja = $request->input('minatKerja');
    if ($minatKerja) {
      foreach ($minatKerja as $minatKerjaId) {
        SyaratMinat::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'minat_kerja_id' => $minatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT UPAYA
    // delete UpayaFisik instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('upayaFisik') and create new UpayaFisik instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratUpaya::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $upayaFisik = $request->input('upayaFisik');
    if ($upayaFisik) {
      foreach ($upayaFisik as $upayaFisikId) {
        SyaratUpaya::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'upaya_fisik_id' => $upayaFisikId
        ]);
      }
    }

    // UPDATING SYARAT FUNGSI
    // delete FungsiPekerjaan instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('fungsiPekerjaan') and create new FungsiPekerjaan instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratFungsi::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $fungsiPekerjaan = $request->input('fungsiPekerjaan');
    if ($fungsiPekerjaan) {
      foreach ($fungsiPekerjaan as $fungsiPekerjaanId) {
        SyaratFungsi::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'fungsi_pekerjaan_id' => $fungsiPekerjaanId
        ]);
      }
    }

    // return redirect()->route('anjab.ajuan.create')->with('success', 'Data Jabatan berhasil Diubah');
    return redirect()->route('anjab.ajuan.edit', ['ajuan' => $ajuan->tahun])->with('success', 'Data Jabatan berhasil Diubah');
  }

  public function anjabVerifikasi(Ajuan $ajuan)
  {
    // When user accepts the ajuan, verification instance is created, 
    // and is_approved in RoleVerifikasi is set to true
    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'verificator_id' => auth()->user()->id,
      'is_approved' => true,
      'catatan' => null
    ]);
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', auth()->user()->roles->first()->id)
      ->update(['is_approved' => true]);

    return redirect()->back()->with('success', 'Verifikasi berhasil');
  }

  public function anjabRevisi(Ajuan $ajuan)
  {
    // When user rejects the ajuan, verification instance is created, 
    // and is_approved in RoleVerifikasi from the previous role is set to false
    // and is_approved in RoleVerifikasi from the current role is also set to false
    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'verificator_id' => auth()->user()->id,
      'is_approved' => false,
      'catatan' => request('catatan')
    ]);

    $previous_verificator_id = Verifikasi::where('ajuan_id', $ajuan->id)
      ->where('is_approved', true)
      ->latest()
      ->first()
      ->verificator_id;
    $previous_verificator_role_id = User::find($previous_verificator_id)->roles->first()->id;
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', $previous_verificator_role_id)
      ->update(['is_approved' => false]);

    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', auth()->user()->roles->first()->id)
      ->update(['is_approved' => false]);

    return redirect()->back()->with('success', 'Revisi berhasil');
  }
}
