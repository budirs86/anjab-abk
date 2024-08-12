<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbkAnjab extends Model
{
    use HasFactory;

    protected $table = 'abk_anjab';

    protected $guarded = ['id'];

    public function anjab()
    {
        return $this->belongsTo(Ajuan::class, 'anjab_id');
    }

    public function abk()
    {
        return $this->belongsTo(Ajuan::class, 'abk_id');
    }
}
