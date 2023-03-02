<?php

namespace arghavan\Product\Providers;


use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Models\Permission;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Product');

        $this->loadRoutesFrom(__DIR__.'/../Routes/product_route.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        config()->set('sidebar.items.products',[
            "icon" => 'i-discounts',
            "title" => 'محصولات',
            "url" => route('products.index'),
            "permission" => Permission::PERMISSION_MANAGE_PRODUCTS
        ]);

    }
}
