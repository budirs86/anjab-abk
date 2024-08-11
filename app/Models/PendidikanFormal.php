<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanFormal extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_formal';
    protected $guarded = ['id'];

    public function kualifikasiJabatan() {
        return $this->belongsTo(KualifikasiJabatan::class);
    }
}
