<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
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
    User::create([
      'name' => 'Alif Rachmat',
      'email' => 'alip@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Admin Kepegawaian');

    User::create([
      'name' => 'Operator Fakultas Teknik',
      'unit_kerja_id' => UnitKerja::where('nama', 'Fakultas Teknik')->first()->id,
      'email' => 'operatorft@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Operator Unit Kerja');

    User::create([
      'name' => 'Manajer Tata Usaha Fakultas Teknik',
      'unit_kerja_id' => UnitKerja::where('nama', 'Fakultas Teknik')->first()->id,
      'email' => 'manajerft@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Manajer Tata Usaha');

    User::create([
      'name' => 'Wakil Dekan 2',
      'unit_kerja_id' => UnitKerja::where('nama', 'Fakultas Teknik')->first()->id,
      'email' => 'wakildekanft@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Wakil Dekan 2');

    User::create([
      'name' => 'Operator Satuan Pengawas Internal',
      'unit_kerja_id' => UnitKerja::where('nama', 'Satuan Pengawas Internal')->first()->id,
      'email' => 'operatorspi@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Operator Unit Kerja');

    User::create([
      'name' => 'Manajer Satuan Pengawas Internal',
      'unit_kerja_id' => UnitKerja::where('nama', 'Satuan Pengawas Internal')->first()->id,
      'email' => 'manajerspi@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Manajer Unit Kerja');

    User::create([
      'name' => 'Kepala Satuan Pengawas Internal',
      'unit_kerja_id' => UnitKerja::where('nama', 'Satuan Pengawas Internal')->first()->id,
      'email' => 'kepalaspi@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Kepala Unit Kerja');

    User::create([
      'name' => 'Manajer Kepegawaian',
      'email' => 'kepegawaian@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Manajer Kepegawaian');

    User::create([
      'name' => 'Kepala Biro Umum dan Keuangan',
      'email' => 'buk@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Kepala BUK');

    User::create([
      'name' => 'Wakil Rektor',
      'email' => 'wakilrektor@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('Wakil Rektor 2');

    User::create([
      'name' => 'Superadmin',
      'email' => 'superadmin@gmail.com',
      'password' => bcrypt('password')
    ])->assignRole('superadmin');
  }
}
