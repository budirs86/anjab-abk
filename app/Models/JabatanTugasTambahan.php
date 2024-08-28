<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanTugasTambahan extends Model
{
    protected $table = 'jabatan_tugas_tambahan';
    protected $fillable = ['nama', 'kode', 'unsur_id', 'jenis_jabatan_id'];

    use HasFactory;

    public function AbkJabatan()
    {
        return $this->hasMany(AbkJabatan::class, 'jabatan_tutam_id');
    }

    public function unsur()
    {
        return $this->belongsTo(Unsur::class);
    }

    public function jenisJabatan()
    {
        return $this->belongsTo(JenisJabatan::class);
    }
}
