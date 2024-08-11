<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisJabatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_jabatan';
    protected $guarded = ['id'];

    public function jabatans() {
        return $this->hasMany(JabatanDiajukan::class);
    }
}
