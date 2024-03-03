<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $roleNames = ['admin', 'guest', 'user', 'editor'];
        foreach ($roleNames as $roleName) {
            Role::findOrCreate($roleName);
        }

        // Define permissions
        $permissions = [
            'post_management' => [
                'create_post',
                'edit_post',
                'delete_post',
            ],
            'user_management' => [
                'create_user',
                'edit_user',
                'delete_user',
            ],
            // Add other permissions as needed
        ];

        // Assign permissions to roles
        $this->assignPermissionsToRole('editor', ['post_management'], $permissions);
        $this->assignPermissionsToRole('admin', ['post_management', 'user_management'], $permissions);
    }

    /**
     * Assign permissions to a specific role.
     *
     * @param string $roleName
     * @param array $permissionGroups
     * @param array $permissions
     */
    protected function assignPermissionsToRole(string $roleName, array $permissionGroups, array $permissions)
    {
        $role = Role::findByName($roleName);

        foreach ($permissionGroups as $groupName) {
            $groupPermissions = collect($permissions[$groupName])->map(function ($permissionName) {
                return Permission::findOrCreate($permissionName);
            });

            $role->syncPermissions($groupPermissions);
        }
    }
}
