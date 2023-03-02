<?php

use Illuminate\Support\Facades\Route;

Route::namespace('arghavan\Brands\Http\Controllers')->middleware(['web','check_auth','auth'])
    ->group(function ($router){

        $router->resource('/brands',BrandController::class);

    });
