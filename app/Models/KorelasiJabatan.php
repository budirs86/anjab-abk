<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorelasiJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jabatan() {
        return $this->belongsTo(JabatanDiajukan::class);
    }

    public function jabatanRelasi() {
        return $this->belongsTo(JabatanDiajukan::class, 'jabatan_relasi_id');
    }
}
