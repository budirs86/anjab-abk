<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function verifikasi()
    {
        return $this->hasMany(Verifikasi::class);
    }

    public function role_verifikasi()
    {
        return $this->hasMany(RoleVerifikasi::class);
    }

    public function next_verificator()
    {
        return $this->role_verifikasi()->where('is_approved', false)->first();
    }
}
