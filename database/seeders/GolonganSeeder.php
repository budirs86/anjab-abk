<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongan_data = array(
            // Golongan I (Juru)
            array(
                "kode" => "IA",
                "nama" => "Juru Muda",
            ),
            array(
                "kode" => "IB",
                "nama" => "Juru Muda Tingkat I",
            ),
            array(
                "kode" => "IC",
                "nama" => "Juru",
            ),
            array(
                "kode" => "ID",
                "nama" => "Juru Tingkat I",
            ),

            // Golongan II (Pengatur)
            array(
                "kode" => "IIA",
                "nama" => "Pengatur Muda",
            ),
            array(
                "kode" => "IIB",
                "nama" => "Pengatur Muda Tingkat I",
            ),
            array(
                "kode" => "IIC",
                "nama" => "Pengatur",
            ),
            array(
                "kode" => "IID",
                "nama" => "Pengatur Tingkat I",
            ),

            // Golongan III (Penata)
            array(
                "kode" => "IIIA",
                "nama" => "Penata Muda",
            ),
            array(
                "kode" => "IIIB",
                "nama" => "Penata Muda Tingkat I",
            ),
            array(
                "kode" => "IIIC",
                "nama" => "Penata",
            ),
            array(
                "kode" => "IIID",
                "nama" => "Penata Tingkat I",
            ),

            // Golongan IV (Pembina)
            array(
                "kode" => "IVA",
                "nama" => "Pembina",
            ),
            array(
                "kode" => "IVB",
                "nama" => "Pembina Tingkat I",
            ),
            array(
                "kode" => "IVC",
                "nama" => "Pembina Muda",
            ),
            array(
                "kode" => "IVD",
                "nama" => "Pembina Muda Tingkat I",
            ),
            array(
                "kode" => "IVE",
                "nama" => "Pembina Utama",
            ),
        );

        foreach ($golongan_data as $golongan) {
            Golongan::create($golongan);
        }
    }
}
