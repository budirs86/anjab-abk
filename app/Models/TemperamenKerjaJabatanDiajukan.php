<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperamenKerjaJabatanDiajukan extends Model
{
    use HasFactory;

    protected $table = 'temperamen_kerja_jabatan_diajukan';
    protected $guarded = ['id'];
}
