<?php

namespace arghavan\Models\Providers;

use arghavan\Models\Models\Models;
use arghavan\Models\Policies\ModelPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Models\Permission;

class ModelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/Model_routs.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Model');

        Gate::policy(Models::class,ModelPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.model',[
            "icon" => "i-courses",
            "title" => "مدل های محصولات",
            "url" => route('models.index'),
            "permission" => [
                Permission::PERMISSION_MANAGE_BRAND_PERMISSION,
            ]
        ]);
    }
}
