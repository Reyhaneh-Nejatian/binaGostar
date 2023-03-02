<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\ProductAttributes\Http\Controllers\AttributeController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->get('/products/{product}/addAttribute','addAttribute')->name('products.addAttribute');

        $router->resource('/attribute',\arghavan\ProductAttributes\Http\Controllers\AttributeController::class);
    });
