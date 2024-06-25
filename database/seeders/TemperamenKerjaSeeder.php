<?php

namespace Database\Seeders;

use App\Models\TemperamenKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemperamenKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/temperamen_kerja.json')), true);

        foreach ($data as $temperamenKerja) {
            TemperamenKerja::create($temperamenKerja);
        }
    }
}
