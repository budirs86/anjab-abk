<?php

namespace Database\Seeders;

use App\Models\JabatanUnsur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanUnsurSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // read data from ./data/jabatan_unsur.json
    $jabatanUnsurs = json_decode(file_get_contents(database_path('seeders/data/jabatan_unsur.json')), true);

    foreach ($jabatanUnsurs as $jabatanUnsur) {
      // create JabatanUnsur
      JabatanUnsur::create($jabatanUnsur);
    }
  }
}
