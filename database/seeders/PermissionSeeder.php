<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions for each module
        $modules = [
            'entities',
            'contacts',
            'activities',
            'deals',
            'users',
            'permissions',
        ];

        $actions = [
            'view',
            'create',
            'edit',
            'delete',
        ];

        $permissions = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissions[] = "$action $module";
            }
        }

        // Create special permissions
        $specialPermissions = [
            'access dashboard',
            'access calendar',
            'manage system',
        ];

        $allPermissions = array_merge($permissions, $specialPermissions);

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($allPermissions);

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view entities', 'create entities', 'edit entities',
            'view contacts', 'create contacts', 'edit contacts',
            'view activities', 'create activities', 'edit activities', 'delete activities',
            'view deals', 'create deals', 'edit deals',
            'access dashboard',
            'access calendar',
            'view users',
            'view permissions',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'view entities', 'create entities',
            'view contacts', 'create contacts',
            'view activities', 'create activities', 'edit activities',
            'view deals', 'create deals',
            'access dashboard',
            'access calendar',
        ]);
    }
}