<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pengalamans';

    public function kualifikasiJabatan() {
        return $this->belongsTo(KualifikasiJabatan::class);
    }
}
