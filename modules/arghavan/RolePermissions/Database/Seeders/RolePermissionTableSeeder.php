<?php


namespace arghavan\RolePermissions\Database\Seeders;

use Illuminate\Database\Seeder;
use arghavan\RolePermissions\Models\Permission;
use arghavan\RolePermissions\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Permission::$permissions as $permission)
        {
            Permission::findOrCreate($permission);
        }

        foreach (Role::$roles as $name => $permission)
        {
            Role::findOrCreate($name)->givePermissionTo($permission);
        }
    }
}
