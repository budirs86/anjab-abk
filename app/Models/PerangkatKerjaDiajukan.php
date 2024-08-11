<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatKerjaDiajukan extends Model
{
    use HasFactory;

    protected $table = 'perangkat_kerja_diajukan';
    protected $guarded = ['id'];
}
