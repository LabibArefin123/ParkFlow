<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $managerRole = Role::firstOrCreate([
            'name' => 'Parking Manager',
            'guard_name' => 'web',
        ]);

        $operatorRole = Role::firstOrCreate([
            'name' => 'Parking Operator',
            'guard_name' => 'web',
        ]);

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@parkflow.test',
            ],
            [
                'name' => 'ParkFlow Administrator',
                'password' => Hash::make('password'),
            ]
        );

        $admin->syncRoles([$adminRole]);

        $manager = User::updateOrCreate(
            [
                'email' => 'manager@parkflow.test',
            ],
            [
                'name' => 'Parking Manager',
                'password' => Hash::make('password'),
            ]
        );

        $manager->syncRoles([$managerRole]);

        $operator = User::updateOrCreate(
            [
                'email' => 'operator@parkflow.test',
            ],
            [
                'name' => 'Parking Operator',
                'password' => Hash::make('password'),
            ]
        );

        $operator->syncRoles([$operatorRole]);
    }
}
