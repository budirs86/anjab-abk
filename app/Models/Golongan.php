<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    public function jabatans() {
        return $this->hasMany(Jabatan::class);
    }
}
