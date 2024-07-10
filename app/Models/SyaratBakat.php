<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratBakat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function syaratJabatan(){
        return $this->belongsTo(SyaratJabatan::class);
    }

    public function bakatKerja(){
        return $this->belongsTo(BakatKerja::class);
    }
}
