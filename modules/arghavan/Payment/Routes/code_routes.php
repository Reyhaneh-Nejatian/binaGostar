<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Payment\Http\Controllers\PaymentController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->resource('/code',\arghavan\Payment\Http\Controllers\CodesController::class);
    });




