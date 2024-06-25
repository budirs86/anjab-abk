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
            "Jabatan Pimpinan Tinggi Utama",
            "Jabatan Pimpinan Tinggi Madya",
            "Jabatan Pimpinan Tinggi Pratama",
            "Jabatan Administrasi Administrator",
            "Jabatan Administrasi Pengawas",
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
