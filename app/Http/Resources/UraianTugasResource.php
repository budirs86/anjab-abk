<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UraianTugasResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'jabatan_id' => $this->jabatan_id,
      'nama_tugas' => $this->nama_tugas,
    ];
  }
}
