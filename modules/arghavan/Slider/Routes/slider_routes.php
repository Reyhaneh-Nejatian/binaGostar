<?php

use Illuminate\Support\Facades\Route;

Route::namespace('arghavan\Slider\Http\Controllers')->middleware(['web','check_auth','auth'])
    ->group(function ($router){

        $router->resource('/sliders',SliderController::class);

    });
