<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;  

    protected $guarded = ['id'];

    protected $with = ['ancestors'];

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function jenisJabatan(){
        return $this->belongsTo(JenisJabatan::class);
    }

    public function analisisJabatan() {
        return $this->hasOne(AnalisisJabatan::class);
    }

    public function kualifikasi() {
        return $this->hasOne(KualifikasiJabatan::class);
    }

    public function uraianTugas() {
        return $this->hasMany(UraianTugas::class);
    }

    public function bahanKerja() {
        return $this->hasMany(BahanKerja::class);
    }
}
