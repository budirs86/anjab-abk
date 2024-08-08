<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';

    protected $guarded = ['id'];

    public function jabatansWithin() {
        // return JabatanUnsur instances where unsur_id = $this->id
        return $this->hasMany(JabatanUnsur::class, 'unsur_id');
    }
}
