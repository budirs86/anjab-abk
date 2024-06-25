<?php

namespace Database\Seeders;

use App\Models\FungsiPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FungsiPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/fungsi_pekerjaan.json')), true);

        foreach ($data as $fungsiPekerjaan) {
            FungsiPekerjaan::create($fungsiPekerjaan);
        }
    }
}
