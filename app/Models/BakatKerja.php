<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakatKerja extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function syaratBakat(){
        return $this->hasMany(SyaratBakat::class);
    }
}
