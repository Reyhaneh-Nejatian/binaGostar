<?php

namespace arghavan\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Dashboard');

        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard_routes.php');

        $this->mergeConfigFrom(__DIR__.'/../Config/sidebar.php','sidebar');
    }

    public function boot()
    {
        $this->app->booted(function (){

            config()->set('sidebar.items.dashboard',[
                "icon" => 'i-dashboard',
                "title" => 'پیشخوان',
                "url" => route('home'),
            ]);
        });
    }
}
