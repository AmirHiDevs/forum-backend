<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleInDatabase = Role::query()->where('name', config('permission.default_roles')[0]);
        $permissionInDatabase = Permission::query()->where('name', config('permission.default_permissions')[0]);

        if ($roleInDatabase->count() < 1) {
            foreach (config('permission.default_roles') as $role) {
                Role::query()->create([
                    'name' => $role
                ]);
            }
        }

        if ($permissionInDatabase->count() < 1) {
            foreach (config('permission.default_permissions') as $permission) {
                Permission::query()->create([
                    'name' => $permission
                ]);
            }
        }
    }
}
