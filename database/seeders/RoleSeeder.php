<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions = Permission::pluck('name')->toArray();

        //Admin Role
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($allPermissions);

        //Salesperson Role
        $salepersonRole = Role::create(['name' => 'salesperson']);
        $salepersonRole->givePermissionTo($allPermissions);

        //Mechanic Role
        $mechanicPermissions = [
            "car-list",
            "car-create",
            "car-edit",
        ];
        $mechanicRole = Role::create(['name' => 'mechanic']);
        $mechanicRole->givePermissionTo($mechanicPermissions);

        //Customer Role
        $customerPermissions = [
            "role-list",
            'car-list',
        ];

        $customerRole = Role::create(['name' => 'customer']);
        $customerRole->givePermissionTo($customerPermissions);
    }
}
