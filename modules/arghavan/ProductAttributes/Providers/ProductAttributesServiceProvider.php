<?php

namespace arghavan\ProductAttributes\Providers;

use arghavan\ProductAttributes\Policies\ProductAttributePolicy;
use arghavan\ProductImage\Models\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class ProductAttributesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/product_attributes_routes.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','ProductAttributes');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        Gate::policy(Image::class,ProductAttributePolicy::class);
    }
}
