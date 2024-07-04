<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // User::factory(10)->create();

        User::create([
            'name' => 'Alif Rachmat',
            'email' => 'alip@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('operator');

        User::create([
            'name' => 'Manajer Kepegawaian',
            'email' => 'kepegawaian@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('manajer_kepegawaian');

        User::create([
            'name' => 'Manajer Tata Usaha',
            'email' => 'tatausaha@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('manajer_tata_usaha');

        User::create([
            'name' => 'Wakil Dekan 2',
            'email' => 'wakildekan@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('wakil_dekan_2');

        User::create([
            'name' => 'Sekretaris Lembaga',
            'email' => 'sekretaris@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('sekretaris_lembaga');

        User::create([
            'name' => 'Kepala Biro Umum dan Keuangan',
            'email' => 'buk@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('kepala_buk');

        User::create([
            'name' => 'Wakil Rektor',
            'email' => 'wakilrektor@gmail.com',
            'password' => bcrypt('password')
        ])->assignRole('wakil_rektor');

        

    }
}
