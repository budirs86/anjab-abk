<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
  use HasFactory;

  protected $table = 'unit_kerja';

  protected $guarded = ['id'];

  public function jabatansWithin()
  {
    // return JabatanUnsur instances where unsur_id = $this->id
    return JabatanUnsur::where('unsur_id', $this->unsur_id)->get();
  }

  public function unsur()
  {
    return $this->belongsTo(Unsur::class);
  }

  public function detailAbk()
  {
    return $this->hasMany(DetailAbk::class);
  }

  // return the latest detailAbk instance
  public function latestDetailAbk()
  {
    return $this->detailAbk()->latest()->first();
  }
}
