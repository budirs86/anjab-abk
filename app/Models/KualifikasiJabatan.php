<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KualifikasiJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }

    public function pendidikanFormals() {
        return $this->hasMany(PendidikanFormal::class);
    }

    public function pendidikanPelatihans() {
        return $this->hasMany(PendidikanPelatihan::class);
    }

    public function pengalaman() {
        return $this->hasMany(Pengalaman::class);
    }
}
