<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratUpaya extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function syaratJabatan(){
        return $this->belongsTo(SyaratJabatan::class);
    }

    public function upayaFisik(){
        return $this->belongsTo(UpayaFisik::class);
    }
}
