<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $can_verify = Permission::create(['name' => 'verify ajuan']);
        $can_make_ajuan = Permission::create(['name' => 'make ajuan']);

        Role::create(['name' => 'operator'])->givePermissionTo($can_make_ajuan);

        // level 1
        Role::create(['name' => 'manajer_kepegawaian'])->givePermissionTo($can_verify);
        Role::create(['name' => 'manajer_tata_usaha'])->givePermissionTo($can_verify);;

        // level 2
        Role::create(['name' => 'wakil_dekan_2'])->givePermissionTo($can_verify);;
        Role::create(['name' => 'sekretaris_lembaga'])->givePermissionTo($can_verify);;
        Role::create(['name' => 'kepala_buk'])->givePermissionTo($can_verify);;

        // level 3
        Role::create(['name' => 'wakil_rektor'])->givePermissionTo($can_verify);;

    }
}
