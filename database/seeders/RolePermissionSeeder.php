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
        $can_make_abk = Permission::create(['name' => 'make abk']);

        Role::create(['name' => 'Operator'])->givePermissionTo($can_make_ajuan);
        Role::create(['name' => 'Operator ABK Unit Kerja'])->givePermissionTo($can_make_abk);

        // level 1
        Role::create(['name' => 'Manajer Kepegawaian'])->givePermissionTo($can_verify);
        Role::create(['name' => 'Manajer Tata Usaha'])->givePermissionTo($can_verify);;

        // level 2
        Role::create(['name' => 'Wakil Dekan 2'])->givePermissionTo($can_verify);;
        Role::create(['name' => 'Sekretaris Lembaga'])->givePermissionTo($can_verify);;
        Role::create(['name' => 'Kepala BUK'])->givePermissionTo($can_verify);;

        // level 3
        Role::create(['name' => 'Wakil Rektor 2'])->givePermissionTo($can_verify);;

        Role::create(['name' => 'superadmin'])->givePermissionTo(['verify ajuan', 'make ajuan']);
    }
}
