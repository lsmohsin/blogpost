<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $memberRole = Role::create(['name' => 'member']);

        // Create permissions
        $permissions = [
            'create-post', 'edit-post', 'delete-post', 'view-post',
            'create-tag', 'edit-tag', 'delete-tag', 'view-tag',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);
        $memberRole->syncPermissions(['create-post', 'view-post', 'delete-post', 'view-post']);
    }

}
