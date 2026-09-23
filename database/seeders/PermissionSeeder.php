<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            /*Dashboard Part  */
            'dashboard',

            /* Profile */
            'profile.show',
            'profile.update',
            'profile.password.update',

            /* Administration Part */
            'administration',

            /*Parking Locations Part */
            'parking_locations.index',
            'parking_locations.show',
            'parking_locations.create',
            'parking_locations.store',
            'parking_locations.edit',
            'parking_locations.update',
            'parking_locations.destroy',

            /*Parking Spots Part  */
            'parking_spots.index',
            'parking_spots.show',
            'parking_spots.create',
            'parking_spots.store',
            'parking_spots.edit',
            'parking_spots.update',
            'parking_spots.destroy',

            /*Parking Map Part  */
            'parking.map',

            /*Parking Sessions*/
            'parking_sessions.index',
            'parking_sessions.show',
            'parking_sessions.create',
            'parking_sessions.store',
            'parking_sessions.edit',
            'parking_sessions.update',
            'parking_sessions.destroy',

            /*Vehicle Entries Part */
            'vehicle_entries.index',
            'vehicle_entries.show',
            'vehicle_entries.create',
            'vehicle_entries.store',
            'vehicle_entries.edit',
            'vehicle_entries.update',
            'vehicle_entries.destroy',

            /*Vehicle Exits Part */
            'vehicle_exits.index',
            'vehicle_exits.show',
            'vehicle_exits.create',
            'vehicle_exits.store',
            'vehicle_exits.edit',
            'vehicle_exits.update',
            'vehicle_exits.destroy',

            /*Active Sessions */
            'sessions.active',

            /*Revenue Part */
            'revenue.index',

            /* Reports Part*/
            'reports.index',

            /* Permissions Part */
            'permissions.index',
            'permissions.show',
            'permissions.create',
            'permissions.store',
            'permissions.edit',
            'permissions.update',
            'permissions.destroy',

            /*Roles Part */
            'roles.index',
            'roles.show',
            'roles.create',
            'roles.store',
            'roles.edit',
            'roles.update',
            'roles.destroy',

            /*System Users Part*/
            'users.index',
            'users.show',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
            'users.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
