<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;  

    protected $guarded = ['id'];

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function jenis_jabatan(){
        return $this->belongsTo(JenisJabatan::class);
    }
    public function golongan(){
        return $this->belongsTo(Golongan::class);
    }
    public function eselon(){
        return $this->belongsTo(Eselon::class);
    }

    public function analisis_jabatan() {
        return $this->hasOne(AnalisisJabatan::class);
    }
}
