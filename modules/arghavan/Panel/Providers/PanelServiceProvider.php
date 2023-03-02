<?php

namespace arghavan\Panel\Providers;

use Illuminate\Support\ServiceProvider;

class PanelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Panel');

        $this->loadRoutesFrom(__DIR__.'/../Routes/panel_routes.php');
    }

    public function boot()
    {

    }
}
