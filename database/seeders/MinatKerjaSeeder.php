<?php

namespace Database\Seeders;

use App\Models\MinatKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/minat_kerja.json')), true);

        foreach ($data as $minatKerja) {
            MinatKerja::create($minatKerja);
        }
    }
}
