<?php

namespace arghavan\Brands\Providers;

use arghavan\Brands\Models\Brand;
use arghavan\Brands\Policies\BrandPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Models\Permission;

class BrandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/Brand_routs.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Brand');

        Gate::policy(Brand::class,BrandPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.brand',[
            "icon" => "i-banners",
            "title" => "برنده های ویژه",
            "url" => route('brands.index'),
            "permission" => [
                Permission::PERMISSION_MANAGE_BRAND_PERMISSION,
            ]
        ]);
    }
}
