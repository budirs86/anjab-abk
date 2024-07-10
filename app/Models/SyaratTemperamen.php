<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratTemperamen extends Model
{
    use HasFactory;

    protected $table = 'syarat_temperamens';

    protected $guarded = ['id'];
}
