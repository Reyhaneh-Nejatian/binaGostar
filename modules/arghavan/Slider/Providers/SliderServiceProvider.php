<?php

namespace arghavan\Slider\Providers;

use arghavan\Slider\Models\Slider;
use arghavan\Slider\Policies\SliderPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use arghavan\RolePermissions\Models\Permission;

class SliderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/slider_routes.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Slider');

        Gate::policy(Slider::class,SliderPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.slider',[
            "icon" => "i-slideshow",
            "title" => "اسلایدر",
            "url" => route('sliders.index'),
            "permission" => [
                Permission::PERMISSION_MANAGE_SLIDER_PERMISSION,
            ]
        ]);
    }
}
