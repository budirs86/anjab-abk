<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JabatanResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return array_merge(parent::toArray($request), [
      'uraian_tugas' => UraianTugasResource::collection($this->whenLoaded('uraianTugas')),
    ]);
  }
}
