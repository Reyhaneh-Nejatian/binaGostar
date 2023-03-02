<?php

namespace arghavan\Front\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/front_route.php');
//        $this->loadRoutesFrom(__DIR__.'/../Routes/api/front_route.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views','Front');

//        view()->composer('Front::layout.header',function ($view){
//            $categories = (new CategoryRepo())->tree();
//            $view->with(compact('categories'));
//        });

//        view()->composer('Front::layout.slider',function ($view) {
//
//            $sliders = (new AddressRepo())->all();
//            $view->with(compact('sliders'));
//        });
//
//        view()->composer('Front::layout.brand-slider',function ($view){
//
//            $brands = (new ModelRepo())->all();
//            $view->with(compact('brands'));
//        });
//
//        view()->composer('Front::layout.sidebar',function ($view){
//           $advertises = (new AdvertiseRepo())->all();
//           $view->with(compact('advertises'));
//        });
    }


    public function boot()
    {

    }
}
