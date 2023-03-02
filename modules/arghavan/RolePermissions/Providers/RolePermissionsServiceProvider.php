<?php

namespace arghavan\RolePermissions\Providers;

use Database\Seeders\DatabaseSeeder;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Database\Seeders\RolePermissionTableSeeder;
use arghavan\RolePermissions\Models\Permission;
use arghavan\RolePermissions\Models\Role;
use arghavan\RolePermissions\Policies\RolePermissionsPolicy;

class RolePermissionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/role_permission.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','RolePermissions');

        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;

        Gate::policy(Role::class,RolePermissionsPolicy::class);

        Gate::before(function ($user){
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        $this->app->booted(function (){
            config()->set('sidebar.items.role-permissions',[
                "icon" => 'i-role-permissions',
                "title" => 'نقش های کاربری',
                "url" => route('role-permissions.index'),
                "permission" => Permission::PERMISSION_MANAGE_ROLE_PERMISSION
            ]);
        });
    }
}

