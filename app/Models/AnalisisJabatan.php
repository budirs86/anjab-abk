<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisJabatan extends Model
{
    use HasFactory;

    public function jabatan() {
        return $this->belongsTo(Jabatan::class);
    }
}
