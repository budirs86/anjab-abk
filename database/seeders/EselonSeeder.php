<?php

namespace Database\Seeders;

use App\Models\Eselon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EselonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        foreach ($eselon as $es) {
            Eselon::create([
                'nama' => $es
            ]);
        }
    }
}
