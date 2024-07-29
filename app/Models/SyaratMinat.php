<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratMinat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // create relationship with MinatKerja
    public function minatKerja() {
        return $this->belongsTo(MinatKerja::class);
    }

    // create relationship with SyaratJabatan
    public function syaratJabatan() {
        return $this->belongsTo(SyaratJabatan::class);
    }
}
