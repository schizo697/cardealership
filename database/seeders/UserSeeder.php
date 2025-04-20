<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Car',
            'email' => 'admin@cardealership.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $sales = User::create([
            'name' => 'Sales Person',
            'email' => 'sales@cardealership.com',
            'password' => Hash::make('password'),
        ]);
        $sales->assignRole('salesperson');

        $mechanic = User::create([
            'name' => 'Mechanic Car',
            'email' => 'mechanic@cardealership.com',
            'password' => Hash::make('password'),
        ]);
        $mechanic->assignRole('mechanic');

        $mechanic1 = User::create([
            'name' => 'Mechanic Car 1',
            'email' => 'mechanic1@cardealership.com',
            'password' => Hash::make('password'),
        ]);
        $mechanic1->assignRole('mechanic');

        $customer = User::create([
            'name' => 'Customer Car',
            'email' => 'customer@cardealership.com',
            'password' => Hash::make('password'),
        ]);
        $customer->assignRole('customer');
    }
}
