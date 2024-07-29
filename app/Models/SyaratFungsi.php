<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratFungsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // create relationship with fungsi pekerjaan
    public function fungsiPekerjaan(){
        return $this->belongsTo(FungsiPekerjaan::class);
    }


}
