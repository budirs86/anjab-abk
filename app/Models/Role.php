<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roleVerifikasi()
    {
        return $this->hasMany(RoleVerifikasi::class);
    }

    public function verifikasi()
    {
        return $this->hasMany(Verifikasi::class);
    }

    public function modelHasRole()
    {
        return $this->hasMany(ModelHasRole::class);
    }
}
