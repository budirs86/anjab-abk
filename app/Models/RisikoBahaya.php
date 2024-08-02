<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RisikoBahaya extends Model
{
    use HasFactory;

    protected $table = 'risiko_bahaya';
    protected $guarded = ['id'];

    public function jabatan() {
        return $this->belongsTo(JabatanDiajukan::class);
    }
}
