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
        $canMakeAnjab = Permission::create(['name' => 'make anjab']);
        $canVerifyAnjab = Permission::create(['name' => 'verify anjab']);
        $canMakeAbk = Permission::create(['name' => 'make abk']);
        $canVerifyAbk = Permission::create(['name' => 'verify abk']);


        // anjab
        Role::create(['name' => 'Admin Kepegawaian'])->givePermissionTo([$canMakeAnjab, $canVerifyAbk]);
        Role::create(['name' => 'Manajer Kepegawaian'])->givePermissionTo($canVerifyAnjab);
        Role::create(['name' => 'Kepala BUK'])->givePermissionTo($canVerifyAnjab);

        // abk
        Role::create(['name' => 'Operator Unit Kerja'])->givePermissionTo($canMakeAbk);
        Role::create(['name' => 'Manajer Unit Kerja'])->givePermissionTo($canVerifyAbk);
        Role::create(['name' => 'Kepala Unit Kerja'])->givePermissionTo($canVerifyAbk);
        Role::create(['name' => 'Manajer Tata Usaha'])->givePermissionTo($canVerifyAbk);
        Role::create(['name' => 'Wakil Dekan 2'])->givePermissionTo($canVerifyAbk);

        Role::create(['name' => 'Wakil Rektor 2'])->givePermissionTo([$canVerifyAnjab, $canVerifyAbk]);

        Role::create(['name' => 'superadmin'])->givePermissionTo(['verify ajuan', 'make ajuan']);
    }
}
