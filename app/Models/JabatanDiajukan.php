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

  public function pendidikanFormal()
  {
    return $this->hasMany(PendidikanFormalDiajukan::class);
  }

  public function pendidikanPelatihan()
  {
    return $this->hasMany(PendidikanPelatihanDiajukan::class);
  }

  public function pengalaman()
  {
    return $this->hasMany(PengalamanDiajukan::class);
  }

  public function uraianTugas()
  {
    return $this->hasMany(UraianTugasDiajukan::class);
  }

  public function bahanKerja()
  {
    return $this->hasMany(BahanKerjaDiajukan::class);
  }

  public function perangkatKerja()
  {
    return $this->hasMany(PerangkatKerjaDiajukan::class);
  }

  public function tanggungJawab()
  {
    return $this->hasMany(TanggungJawabDiajukan::class);
  }

  public function wewenang()
  {
    return $this->hasMany(WewenangDiajukan::class);
  }

  public function korelasiJabatan()
  {
    return $this->hasMany(KorelasiJabatanDiajukan::class);
  }

  public function risikoBahaya()
  {
    return $this->hasMany(RisikoBahayaDiajukan::class);
  }

  public function jabatanUnsur()
  {
    return $this->hasMany(JabatanUnsur::class);
  }

  public function detailAbk()
  {
    return $this->hasMany(DetailAbk::class);
  }
}
