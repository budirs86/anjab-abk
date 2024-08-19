<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanJabatan;
use App\Models\BakatKerja;
use App\Models\BakatKerjaJabatanDiajukan;
use App\Models\FungsiPekerjaan;
use App\Models\FungsiPekerjaanJabatanDiajukan;
use App\Models\Jabatan;
use App\Models\JabatanDiajukan;
use App\Models\JenisJabatan;
use App\Models\KondisiLingkunganKerja;
use App\Models\KualifikasiJabatan;
use App\Models\MinatKerja;
use App\Models\MinatKerjaJabatanDiajukan;
use App\Models\Role;
use App\Models\RoleVerifikasi;
use App\Models\SyaratBakat;
use App\Models\SyaratFungsi;
use App\Models\SyaratJabatan;
use App\Models\SyaratMinat;
use App\Models\SyaratTemperamen;
use App\Models\SyaratUpaya;
use App\Models\TemperamenKerja;
use App\Models\TemperamenKerjaJabatanDiajukan;
use App\Models\UnitKerja;
use App\Models\Unsur;
use App\Models\UpayaFisik;
use App\Models\UpayaFisikJabatanDiajukan;
use App\Models\UraianTugas;
use App\Models\UraianTugasDiajukan;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AjuanController extends Controller
{
  public function anjabIndex()
  {
    $title = 'Ajuan Jabatan';
    $ajuans = Ajuan::where('jenis', 'anjab')->get();

    // If logged user has role 'Admin Kepegawaian', display all ajuans
    // If logged user has role 'Manajer Kepegawaian', display only ajuans that are verified by 'Admin Kepegawaian'
    // If logged user has role 'Kepala BUK', display only ajuans that are verified by 'Manajer Kepegawaian'
    // If logged user has role 'Wakil Rektor 2', display only ajuans that are verified by 'Kepala BUK'
    // If logged
    if (auth()->user()->hasRole('Admin Kepegawaian')) {
      $ajuans = Ajuan::where('jenis', 'anjab')->get();
    } elseif (auth()->user()->hasRole('Manajer Kepegawaian')) {
      $ajuans = Ajuan::anjab_for_manajer_kepegawaian();
    } elseif (auth()->user()->hasRole('Kepala BUK')) {
      $ajuans = Ajuan::anjab_for_kepala_buk();
    } elseif (auth()->user()->hasRole('Wakil Rektor 2')) {
      $ajuans = Ajuan::anjab_for_wakil_rektor_2();
    }

    return view('anjab.ajuans', compact('title', 'ajuans'));
  }

  public function anjabCreate()
  {
    $title = 'Buat Ajuan Baru';
    $jenisJabatan = JenisJabatan::all();
    // $unitKerjas = UnitKerja::all();
    $unsurs = Unsur::all();

    // check if there is an ajuan draft
    if (!JabatanDiajukan::is_draft_exist()) {
      // if no draft exists, fetch the JSON data
      $response = Http::get('http://anjab-abk.test/api/jabatans');

      // if the request isn't successful or the data isn't found, redirect back with an error message
      if (!$response->successful() || !isset($response['data'])) {
        return redirect()->back()->with('error', 'Data Jabatan tidak ditemukan');
      }

      $jabatans = $response['data'];

      foreach ($jabatans as $dataJabatan) {
        $jabatanData[] = [
          'jabatan_id' => $dataJabatan['id'],
          'ajuan_id' => null,
          'parent_id' => $dataJabatan['parent_id'],
          'nama' => $dataJabatan['nama'],
          'kode' => $dataJabatan['kode'],
          'ikhtisar' => $dataJabatan['ikhtisar'],
          'prestasi' => $dataJabatan['prestasi'],
        ];

        foreach ($dataJabatan['uraian_tugas'] as $uraianTugas) {
          $uraianTugasData[] = [
            'jabatan_diajukan_id' => $dataJabatan['id'],
            'nama_tugas' => $uraianTugas['nama_tugas'],
          ];
        }
      }

      JabatanDiajukan::insert($jabatanData);
      UraianTugasDiajukan::insert($uraianTugasData);
    }

    // fetch the existing or newly created drafts
    $jabatans = JabatanDiajukan::where('ajuan_id', null)->with('uraianTugas')->tree()->get()->toTree();

    return view('anjab.buat-ajuan', compact('title', 'jabatans', 'jenisJabatan', 'unsurs'));
  }

  public function anjabStore()
  {
    $ajuan = Ajuan::create([
      'tahun' => now()->year,
      'jenis' => 'anjab'
    ]);

    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'user_id' => auth()->user()->id,
      'is_approved' => true,
      'catatan' => null
    ]);

    // After creating an ajuan, roles that can verify the ajuan
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => Role::where('name', 'Admin Kepegawaian')->first()->id,
      'is_approved' => true
    ]);
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => Role::where('name', 'Manajer Kepegawaian')->first()->id,
      'is_approved' => true
    ]);
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => Role::where('name', 'Kepala BUK')->first()->id,
      'is_approved' => true
    ]);
    RoleVerifikasi::create([
      'ajuan_id' => $ajuan->id,
      'role_id' => Role::where('name', 'Wakil Rektor 2')->first()->id,
      'is_approved' => true
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
    $jabatans = JabatanDiajukan::where('ajuan_id', $ajuan->id)->get();
    return view('anjab.ajuan', compact('title', 'ajuan', 'jabatans'));
  }

  public function anjabEdit($tahun, $id)
  {
    // $jabatans = Jabatan::tree()->get()->toTree();
    $ajuan = Ajuan::where('id', $id)->first();
    $title = 'Ajuan Jabatan';
    $jabatans = JabatanDiajukan::where('ajuan_id', $ajuan->id)->get();
    $editable = true;
    return view('anjab.ajuan.edit', compact('title', 'ajuan', 'jabatans', 'editable'));
  }

  public function anjabUpdate(Ajuan $ajuan)
  {
    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'user_id' => auth()->user()->id,
      'is_approved' => true,
      'catatan' => null
    ]);
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', auth()->user()->roles->first()->id)
      ->update(['is_approved' => true]);

    return redirect()->route('anjab.ajuan.index')->with('success', 'Data Ajuan berhasil Diubah');
  }

  public function anjabShowJabatan(Ajuan $ajuan, JabatanDiajukan $jabatan)
  {
    $title = 'Lihat Informasi Jabatan';
    $bakat_kerjas = BakatKerja::all();
    $unit_kerjas = UnitKerja::all();
    $jenis_jabatan = JenisJabatan::all();
    $temperamens = TemperamenKerja::all();
    $upaya_fisiks = UpayaFisik::all();
    $fungsi_pekerjaans = FungsiPekerjaan::all();
    $checkedBakatKerja = BakatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('bakat_kerja_id')->toArray();
    $checkedTemperamenKerja = TemperamenKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('temperamen_kerja_id')->toArray();
    $checkedMinatKerja = MinatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('minat_kerja_id')->toArray();
    $checkedUpayaFisik = UpayaFisikJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('upaya_fisik_id')->toArray();
    $checkedFungsiPekerjaan = FungsiPekerjaanJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('fungsi_pekerjaan_id')->toArray();
    return view('anjab.jabatan.show', compact(
      'ajuan',
      'jabatan',
      'title',
      'bakat_kerjas',
      'unit_kerjas',
      'jenis_jabatan',
      'temperamens',
      'upaya_fisiks',
      'fungsi_pekerjaans',
      'checkedBakatKerja',
      'checkedTemperamenKerja',
      'checkedMinatKerja',
      'checkedUpayaFisik',
      'checkedFungsiPekerjaan'
    ));
  }

  public function anjabEditJabatan1(Ajuan $ajuan, JabatanDiajukan $jabatan)
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

  public function anjabUpdateJabatan1(Request $request, Ajuan $ajuan, JabatanDiajukan $jabatan)
  {
    $jabatan->update($request->all());

    return redirect()->route('anjab.ajuan.jabatan.edit.2', ['ajuan' => $ajuan->tahun, 'jabatan' => $jabatan])->with('success', 'Data Jabatan berhasil Diubah');
  }

  public function anjabEditJabatan2(Ajuan $ajuan, JabatanDiajukan $jabatan)
  {
    $title = 'Form Informasi Jabatan';
    $jabatans = JabatanDiajukan::orderBy('nama')->get();
    $bakatKerja = BakatKerja::all();
    $unitKerja = UnitKerja::all();
    $jenisJabatan = JenisJabatan::all();
    $temperamen = TemperamenKerja::all();
    $upayaFisik = UpayaFisik::all();
    $fungsiPekerjaan = FungsiPekerjaan::all();
    $minatKerja = MinatKerja::all();


    // get necessary data for checkboxes
    // checkboxes are checked if the data is found in the database
    $checkedBakatKerja = BakatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('bakat_kerja_id')->toArray();
    $checkedTemperamenKerja = TemperamenKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('temperamen_kerja_id')->toArray();
    $checkedMinatKerja = MinatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('minat_kerja_id')->toArray();
    $checkedUpayaFisik = UpayaFisikJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('upaya_fisik_id')->toArray();
    $checkedFungsiPekerjaan = FungsiPekerjaanJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->get()->pluck('fungsi_pekerjaan_id')->toArray();

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

  public function anjabUpdateJabatan2(Request $request, Ajuan $ajuan, JabatanDiajukan $jabatan)
  {
    // loop through $request->input('kondisiLingkunganKerja') and put them all inside $kondisi
    $kondisi = [];
    foreach ($request->input('kondisiLingkunganKerja') as $key => $value) {
      $kondisi[$key] = $value;
      $jabatan->$key = $value;
      $jabatan->save();
    }

    $jabatan->keterampilan = $request->input('keterampilan');
    $jabatan->save();

    // UPDATING SYARAT BAKAT
    // delete SyaratBakat instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('bakatKerja') and create new SyaratBakat instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    BakatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->delete();
    $bakatKerja = $request->input('bakatKerja');
    if ($bakatKerja) {
      foreach ($bakatKerja as $bakatKerjaId) {
        BakatKerjaJabatanDiajukan::create([
          'jabatan_diajukan_id' => $jabatan->id,
          'bakat_kerja_id' => $bakatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT TEMPERAMEN
    // delete SyaratTemperamen instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('temperamenKerja') and create new SyaratTemperamen instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    TemperamenKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->delete();
    $temperamenKerja = $request->input('temperamenKerja');
    if ($temperamenKerja) {
      foreach ($temperamenKerja as $temperamenKerjaId) {
        TemperamenKerjaJabatanDiajukan::create([
          'jabatan_diajukan_id' => $jabatan->id,
          'temperamen_kerja_id' => $temperamenKerjaId
        ]);
      }
    }

    // UPDATING SYARAT MINAT
    // delete MinatKerja instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('minatKerja') and create new MinatKerja instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    MinatKerjaJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->delete();
    $minatKerja = $request->input('minatKerja');
    if ($minatKerja) {
      foreach ($minatKerja as $minatKerjaId) {
        MinatKerjaJabatanDiajukan::create([
          'jabatan_diajukan_id' => $jabatan->id,
          'minat_kerja_id' => $minatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT UPAYA
    // delete UpayaFisik instances with jabatan_diajukan_id = $syaratJabatan->id
    // loop through $request->input('upayaFisik') and create new UpayaFisik instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    UpayaFisikJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->delete();
    $upayaFisik = $request->input('upayaFisik');
    if ($upayaFisik) {
      foreach ($upayaFisik as $upayaFisikId) {
        UpayaFisikJabatanDiajukan::create([
          'jabatan_diajukan_id' => $jabatan->id,
          'upaya_fisik_id' => $upayaFisikId
        ]);
      }
    }

    // Updating Kondisi Fisik
    $jabatan->jenis_kelamin = $request->input('jenis_kelamin');
    $jabatan->umur = $request->input('umur');
    $jabatan->tinggi_badan = $request->input('tinggi_badan');
    $jabatan->berat_badan = $request->input('berat_badan');
    $jabatan->postur_badan = $request->input('postur_badan');
    $jabatan->penampilan = $request->input('penampilan');
    $jabatan->save();

    // UPDATING SYARAT FUNGSI
    // delete FungsiPekerjaan instances with jabatan_diajukan_id = $syaratJabatan->id
    // loop through $request->input('fungsiPekerjaan') and create new FungsiPekerjaan instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    FungsiPekerjaanJabatanDiajukan::where('jabatan_diajukan_id', $jabatan->id)->delete();
    $fungsiPekerjaan = $request->input('fungsiPekerjaan');
    if ($fungsiPekerjaan) {
      foreach ($fungsiPekerjaan as $fungsiPekerjaanId) {
        FungsiPekerjaanJabatanDiajukan::create([
          'jabatan_diajukan_id' => $jabatan->id,
          'fungsi_pekerjaan_id' => $fungsiPekerjaanId
        ]);
      }
    }

    return redirect()->route('anjab.ajuan.edit', ['tahun' => $ajuan->tahun, 'id' => $ajuan->id])->with('success', 'Data Jabatan berhasil Diubah');
  }

  public function anjabVerifikasi(Ajuan $ajuan)
  {
    // When user accepts the ajuan, verification instance is created, 
    // and is_approved in RoleVerifikasi is set to true
    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'user_id' => auth()->user()->id,
      'is_approved' => true,
      'catatan' => null
    ]);
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', auth()->user()->roles->first()->id)
      ->update(['is_approved' => true]);

    return redirect()->back()->with('success', 'Verifikasi berhasil');
  }

  // When user rejects the ajuan, verification instance is created, 
  // is_approved in RoleVerifikasi from the previous role is set to false
  // and is_approved in RoleVerifikasi from the current role is also set to false
  public function anjabRevisi(Ajuan $ajuan)
  {
    // Create a new verification instance
    Verifikasi::create([
      'ajuan_id' => $ajuan->id,
      'user_id' => auth()->user()->id,
      'is_approved' => false,
      'catatan' => request('catatan')
    ]);

    // Get all role ids that can verify the ajuan
    $verificatorIds = RoleVerifikasi::where('ajuan_id', $ajuan->id)->get()->pluck('role_id')->toArray();
    // Get the role id of the previous verificator
    $previousVerificatorRoleId = $verificatorIds[array_search(auth()->user()->roles->first()->id, $verificatorIds) - 1];

    // Set is_approved in RoleVerifikasi from the previous role to false
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', $previousVerificatorRoleId)
      ->update(['is_approved' => false]);

    // Set is_approved in RoleVerifikasi from the current role to false
    RoleVerifikasi::where('ajuan_id', $ajuan->id)
      ->where('role_id', auth()->user()->roles->first()->id)
      ->update(['is_approved' => false]);

    return redirect()->back()->with('success', 'Revisi berhasil');
  }
}
