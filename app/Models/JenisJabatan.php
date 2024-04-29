<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatans() {
        return $this->hasMany(Jabatan::class);
    }
}
