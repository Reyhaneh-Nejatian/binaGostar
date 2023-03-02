<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Product\Http\Controllers\ProductController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->resource('/products',\arghavan\Product\Http\Controllers\ProductController::class);

        $router->patch('/products/{product}/accept','accept')->name('products.accept');
        $router->patch('/products/{product}/reject','reject')->name('products.reject');
        $router->patch('/products/{product}/lock','lock')->name('products.lock');

//        $router->patch('/products/{product}/lock','lock')->name('products.lock');
    });


