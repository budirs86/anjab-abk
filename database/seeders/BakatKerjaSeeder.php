<?php

namespace Database\Seeders;

use App\Models\BakatKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BakatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/bakat_kerja.json')), true);

        foreach ($data as $bakatKerja) {
            BakatKerja::create($bakatKerja);
        }
    }
}
