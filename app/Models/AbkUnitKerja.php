<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbkUnitKerja extends Model
{
    use HasFactory;
    protected $table = 'abk_unit_kerja';
    protected $guarded = ['id'];

    public function ajuan()
    {
        return $this->belongsTo(Ajuan::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
