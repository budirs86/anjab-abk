<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan(){
        return $this->belongsTo(Jabatan::class);
    }

    public function syaratBakat(){
        return $this->hasMany(SyaratBakat::class);
    }
}
