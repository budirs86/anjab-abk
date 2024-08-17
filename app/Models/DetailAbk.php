<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAbk extends Model
{
    use HasFactory;

    protected $table = 'detail_abk';
    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function uraianTugasDiajukan()
    {
        return $this->belongsTo(UraianTugasDiajukan::class);
    }

    public function ajuan()
    {
        return $this->belongsTo(Ajuan::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }    
}
