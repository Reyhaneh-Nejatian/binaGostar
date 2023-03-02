<?php

use Illuminate\Support\Facades\Route;

Route::namespace('arghavan\Models\Http\Controllers')->middleware(['web','check_auth','auth'])
    ->group(function ($router){

        $router->resource('/models',ModelController::class);

    });
