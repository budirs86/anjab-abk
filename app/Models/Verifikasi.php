<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

    protected $table = 'verifikasi';
    protected $guarded = ['id'];

    public function ajuan()
    {
        return $this->belongsTo(Ajuan::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function verificator()
    {
        return $this->belongsTo(User::class);
    }
}
