<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\Golongan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JenisJabatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BakatKerjaSeeder::class,
            TemperamenKerjaSeeder::class,
            MinatKerjaSeeder::class,
            FungsiPekerjaanSeeder::class,
            UserSeeder::class,
            JenisJabatanSeeder::class,
            EselonSeeder::class,
            GolonganSeeder::class,
            // JabatanSeeder::class,
        ]);
    }
}
