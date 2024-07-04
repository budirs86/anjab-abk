<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\KualifikasiJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_fakultas_teknik = json_decode(file_get_contents(database_path('seeders/data/jabatan/fakultas_teknik.json')), true);

        $data = array_merge($data_fakultas_teknik);

        foreach ($data as $jabatan) {
            Jabatan::create($jabatan);
        }

        for ($i = 1; $i < count($data); $i++) {
            KualifikasiJabatan::create(
                [
                    'jabatan_id' => $i
                ]
            );
        }
    }
}
