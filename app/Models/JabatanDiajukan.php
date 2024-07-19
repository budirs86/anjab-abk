<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanDiajukan extends Model
{
  use HasFactory;

  // table name is 'jabatan_diajukan'
  protected $table = 'jabatan_diajukan';

  protected $guarded = ['id'];

  // check if there is an ajuan draft
  public static function is_draft_exist()
  {
    // if model does not have instance, return false
    // if model has instance and its latest instance's 'ajuan_id' is not null, return false
    // if model has instance and its latest instance's 'ajuan_id' is null, return true
    return JabatanDiajukan::count() == 0 ? false : JabatanDiajukan::latest()->first()->ajuan_id == null;
  }

  public function jenisJabatan()
  {
    return $this->belongsTo(JenisJabatan::class);
  }

  public function analisisJabatan()
  {
    return $this->hasOne(AnalisisJabatan::class);
  }

  public function kualifikasi()
  {
    return $this->hasOne(KualifikasiJabatan::class, 'jabatan_id');
  }

  public function uraianTugas()
  {
    return $this->hasMany(UraianTugas::class, 'jabatan_id');
  }

  public function bahanKerja()
  {
    return $this->hasMany(BahanKerja::class, 'jabatan_id');
  }

  public function perangkatKerja()
  {
    return $this->hasMany(PerangkatKerja::class, 'jabatan_id');
  }

  public function tanggungJawab()
  {
    return $this->hasMany(TanggungJawab::class, 'jabatan_id');
  }

  public function wewenang()
  {
    return $this->hasMany(Wewenang::class, 'jabatan_id');
  }

  public function korelasiJabatan()
  {
    return $this->hasMany(KorelasiJabatan::class, 'jabatan_id');
  }

  public function risikoBahaya()
  {
    return $this->hasMany(RisikoBahaya::class, 'jabatan_id');
  }

  public function kondisiLingkunganKerja()
  {
    return $this->hasOne(KondisiLingkunganKerja::class, 'jabatan_id');
  }

  public function syaratJabatan()
  {
    return $this->hasOne(SyaratJabatan::class, 'jabatan_id');
  }
}
