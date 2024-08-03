<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisikoBahayaDiajukan extends Model
{
    use HasFactory;

    protected $table = 'risiko_bahaya_diajukan';
    protected $guarded = ['id'];
}
