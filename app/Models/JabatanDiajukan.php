<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanDiajukan extends Model
{
  use HasFactory;

  // table name is 'jabatan_diajukan'
  protected $table = 'jabatan_diajukan';

  protected $guarded = ['id'];

  // check if there is an ajuan draft
  public static function is_draft_exist()
  {
    // if model does not have instance, return false
    // if model has instance and its latest instance's 'ajuan_id' is not null, return false
    // if model has instance and its latest instance's 'ajuan_id' is null, return true
    return JabatanDiajukan::count() == 0 ? false : JabatanDiajukan::latest()->first()->ajuan_id == null;
  }
}
