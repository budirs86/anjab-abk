<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    // Verifikasi belongs to ajuan
    public function ajuan()
    {
        return $this->belongsTo(Ajuan::class);
    }
}
