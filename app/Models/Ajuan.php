<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuan extends Model
{
  use HasFactory;

  protected $guarded = ['id'];

  public function verifikasi()
  {
    return $this->hasMany(Verifikasi::class);
  }

  public function role_verifikasi()
  {
    return $this->hasMany(RoleVerifikasi::class);
  }

  // Ajuan for manajer kepegawaian
  // Get ajuan where jenis = anjab and already approved by operator
  public static function anjab_for_manajer_kepegawaian()
  {
    return Ajuan::where('jenis', 'anjab')->whereHas('role_verifikasi', function ($query) {
      $query->where('role_id', 1)->where('is_approved', true);
    })->get();
  }

  // Ajuan for kepala buk
  // Get ajuan where jenis = anjab and already approved by manajer kepegawaian
  public static function anjab_for_kepala_buk()
  {
    return Ajuan::where('jenis', 'anjab')->whereHas('role_verifikasi', function ($query) {
      $query->where('role_id', 2)->where('is_approved', true);
    })->get();
  }

  // Ajuan for wakil rektor 2
  // Get ajuan where jenis = anjab and already approved by kepala buk
  public static function anjab_for_wakil_rektor_2()
  {
    return Ajuan::where('jenis', 'anjab')->whereHas('role_verifikasi', function ($query) {
      $query->where('role_id', 6)->where('is_approved', true);
    })->get();
  }

  // Get the latest verifikasi (excluding operator)
  public function latest_verifikasi()
  {
    return $this->verifikasi()->latest()->first();
  }

  // Get the latest verificator
  public function latest_verificator()
  {
    return $this->role_verifikasi()->latest()->first();
  }

  // Get the next verificator that has not approved the ajuan
  public function next_verificator()
  {
    return $this->role_verifikasi()->where('is_approved', false)->first();
  }

  // Get all verificator that has approved the ajuan
  public function approved_verificator()
  {
    return $this->role_verifikasi()->where('is_approved', true)->get();
  }

  // Check if all verificator has approved the ajuan
  public function is_approved()
  {
    return $this->role_verifikasi()->where('is_approved', true)->count() == $this->role_verifikasi()->count();
  }
}
