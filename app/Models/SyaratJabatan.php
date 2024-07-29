<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan(){
        return $this->belongsTo(JabatanDiajukan::class);
    }

    public function syaratBakat(){
        return $this->hasMany(SyaratBakat::class);
    }

    // create hasmany relation with temperamenkerja
    public function SyaratTemperamens(){
        return $this->hasMany(SyaratTemperamen::class);
    }

    // create hasmany relation with syaratminat
    public function SyaratMinats(){
        return $this->hasMany(SyaratMinat::class);
    }

    // create hasmany relation with syaratupaya
    public function SyaratUpayas(){
        return $this->hasMany(SyaratUpaya::class);
    }

    // create hasmany relation with syaratfungsi
    public function SyaratFungsis(){
        return $this->hasMany(SyaratFungsi::class);
    }
}
