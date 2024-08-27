<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanTugasTambahan extends Model
{
    protected $table = 'jabatan_tugas_tambahan';

    use HasFactory;

    public function AbkJabatan()
    {
        return $this->hasMany(AbkJabatan::class, 'jabatan_tutam_id');
    }
}
