<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;  

    protected $guarded = ['id'];

    protected $table = 'jabatan';

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function uraianTugas()
    {
        return $this->hasMany(UraianTugas::class);
    }
}
