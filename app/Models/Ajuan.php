<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuan extends Model
{
    use HasFactory;

    // Ajuan has many verfiikasi
    public function verifikasis()
    {
        return $this->hasMany(Verifikasi::class);
    }

    protected $guarded = ['id'];
}
