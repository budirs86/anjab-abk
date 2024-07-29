<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratTemperamen extends Model
{
    use HasFactory;

    protected $table = 'syarat_temperamens';

    protected $guarded = ['id'];

    // create relationship with syarat_jabatan and temperamen kerja
    public function syaratJabatan(){
        return $this->belongsTo(SyaratJabatan::class);
    }

    public function temperamenKerja(){
        return $this->belongsTo(TemperamenKerja::class);
    }
}
