<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbkJabatan extends Model
{
    use HasFactory;

    public $table = 'abk_jabatan';

    protected $guarded = ['id'];

    public function abk()
    {
        return $this->belongsTo(Ajuan::class, 'abk_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanDiajukan::class, 'jabatan_id');
    }

    public function jabatanTugasTambahan()
    {
        return $this->belongsTo(JabatanTugasTambahan::class);
    }

    public function detailAbk()
    {
        return $this->hasMany(DetailAbk::class);
    }
}
