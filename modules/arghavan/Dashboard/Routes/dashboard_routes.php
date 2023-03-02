<?php
use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Dashboard\Http\Controllers\DashboardController::class)
    ->middleware(['web'])
    ->group(function ($router){

        $router->get('/panel/admin','home')->name('home');
    });


