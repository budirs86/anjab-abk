<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorelasiJabatanDiajukan extends Model
{
    use HasFactory;

    protected $table = 'korelasi_jabatan_diajukan';
    protected $guarded = ['id'];
}
