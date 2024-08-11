<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakatKerjaJabatanDiajukan extends Model
{
    use HasFactory;

    protected $table = 'bakat_kerja_jabatan_diajukan';
    protected $guarded = ['id'];
}
