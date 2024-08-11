<?php

namespace Database\Seeders;

use App\Models\UraianTugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UraianTugasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = json_decode(file_get_contents(database_path('seeders/data/uraian_tugas.json')), true);

    foreach ($data as $uraianTugas) {
      UraianTugas::create($uraianTugas);
    }
  }
}
