<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanUnsur extends Model
{
    use HasFactory;

    protected $table = 'jabatan_unsur';
    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->belongsTo(JabatanDiajukan::class);
    }

    public function unsur()
    {
        return $this->belongsTo(Unsur::class);
    }
}
