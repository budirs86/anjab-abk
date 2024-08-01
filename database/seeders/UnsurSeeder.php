<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unsur;

class UnsurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $unsurs = [
            "Wakil Rektor",
            "Fakultas/Sekolah",
            "Lembaga",
            "Badan",
            "Biro",
            "Direktorat",
            "Unit Pelaksana Teknis",
            "Kantor",
            "Satuan Pengawas Internal",
            "Dewan Penasihat Universitas"
        ];

        foreach($unsurs as $unsur) {
            Unsur::create([
                'nama' => $unsur
            ]);
        };
    }
}
