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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        User::create([
            'name' => 'Alif Rachmat',
            'email' => 'alip@gmail.com',
            'password' => bcrypt('password')
        ]);

        $jenis_jabatan = [
            "Jabatan Pimpinan Tinggi Utama",
            "Jabatan Pimpinan Tinggi Madya",
            "Jabatan Pimpinan Tinggi Pratama",
            "Jabatan Administrasi Administrator",
            "Jabatan Administrasi Pengawas",
            "Jabatan Administrasi Pelaksana",
            "Jabatan Fungsional",
        ];

        $eselon = [
            "Eselon I",
            "Eselon IA",
            "Eselon IB",
            "Eselon II",
            "Eselon IIA",
            "Eselon IIB",
            "Eselon III",
            "Eselon IIIA",
            "Eselon IIIB",
        ];

        $golongan_data = array(
        // Golongan I (Juru)
        array(
            "golongan" => "IA",
            "nama" => "Juru Muda",
        ),
        array(
            "golongan" => "IB",
            "nama" => "Juru Muda Tingkat I",
        ),
        array(
            "golongan" => "IC",
            "nama" => "Juru",
        ),
        array(
            "golongan" => "ID",
            "nama" => "Juru Tingkat I",
        ),
        
        // Golongan II (Pengatur)
        array(
            "golongan" => "IIA",
            "nama" => "Pengatur Muda",
        ),
        array(
            "golongan" => "IIB",
            "nama" => "Pengatur Muda Tingkat I",
        ),
        array(
            "golongan" => "IIC",
            "nama" => "Pengatur",
        ),
        array(
            "golongan" => "IID",
            "nama" => "Pengatur Tingkat I",
        ),
        
        // Golongan III (Penata)
        array(
            "golongan" => "IIIA",
            "nama" => "Penata Muda",
        ),
        array(
            "golongan" => "IIIB",
            "nama" => "Penata Muda Tingkat I",
        ),
        array(
            "golongan" => "IIIC",
            "nama" => "Penata",
        ),
        array(
            "golongan" => "IIID",
            "nama" => "Penata Tingkat I",
        ),
        
        // Golongan IV (Pembina)
        array(
            "golongan" => "IVA",
            "nama" => "Pembina",
        ),
        array(
            "golongan" => "IVB",
            "nama" => "Pembina Tingkat I",
        ),
        array(
            "golongan" => "IVC",
            "nama" => "Pembina Muda",
        ),
        array(
            "golongan" => "IVD",
            "nama" => "Pembina Muda Tingkat I",
        ),
        array(
            "golongan" => "IVE",
            "nama" => "Pembina Utama",
        ),
        );

        foreach ($jenis_jabatan as $jenis) {
            JenisJabatan::create([
                'jenis_jabatan' => $jenis
            ]);
        }
        foreach ($eselon as $es) {
            Eselon::create([
                'eselon' => $es
            ]);
        }
        foreach ($golongan_data as $golongan) {
            Golongan::create($golongan);
        }

        Jabatan::create([
            'nama_jabatan' => 'Kepala Dinas',
            'jenis_jabatan_id' => '1',
            'eselon_id' => '1',
            'golongan_id' => '1',
            'kode' => '',
            'unit_kerja' => 'Unit Kerja deh Pokoknya',
            'parent_id' => null,
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Sekretaris Dinas',
            'jenis_jabatan_id' => '1',
            'eselon_id' => '1',
            'golongan_id' => '1',
            'kode' => '',
            'unit_kerja' => 'Unit Kerja deh Pokoknya',
            'parent_id' => 1,
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Bawahannya Sekretaris Dinas',
            'jenis_jabatan_id' => '1',
            'eselon_id' => '1',
            'golongan_id' => '1',
            'kode' => '',
            'unit_kerja' => 'Unit Kerja deh Pokoknya',
            'parent_id' => 2,
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Bawahannya Kepala Dinas',
            'jenis_jabatan_id' => '1',
            'eselon_id' => '1',
            'golongan_id' => '1',
            'kode' => '',
            'unit_kerja' => 'Unit Kerja deh Pokoknya',
            'parent_id' => 1,
        ]);
    }
}
