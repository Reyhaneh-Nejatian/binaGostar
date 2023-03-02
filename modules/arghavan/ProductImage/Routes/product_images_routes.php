<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\ProductImage\Http\Controllers\ImageController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->get('/products/{product}/addImage','addImage')->name('products.addImage');

        $router->resource('/images',\arghavan\ProductImage\Http\Controllers\ImageController::class);
    });
