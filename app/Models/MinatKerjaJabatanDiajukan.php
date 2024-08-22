<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatKerjaJabatanDiajukan extends Model
{
    use HasFactory;

    protected $table = 'minat_kerja_jabatan_diajukan';
    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->belongsTo(JabatanDiajukan::class);
    }
}
