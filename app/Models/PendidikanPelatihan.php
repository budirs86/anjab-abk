<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanPelatihan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_pelatihan';
    protected $guarded = ['id'];

    public function kualifikasiJabatan() {
        return $this->belongsTo(KualifikasiJabatan::class);
    }
}
