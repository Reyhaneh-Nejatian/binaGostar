<?php

namespace arghavan\ProductImage\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\ProductImage\Models\Image;
use arghavan\ProductAttributes\Policies\ProductAttributePolicy;

class ProductImagesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/product_images_routes.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','ProductImages');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        Gate::policy(Image::class,ProductAttributePolicy::class);
    }
}
