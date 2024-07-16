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

  // Get the latest verifikasi
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
