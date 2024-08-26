<?php

namespace Database\Seeders;

use App\Models\JenisJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_jabatan = [
            "Setara Eselon I",
            "Setara Eselon II",
            "Setara Eselon III",
            "Setara Eselon IV",
            "Jabatan Administrasi Pelaksana",
            "Jabatan Fungsional",
        ];

        foreach ($jenis_jabatan as $jenis) {
            JenisJabatan::create([
                'nama' => $jenis
            ]);
        }
    }
}
