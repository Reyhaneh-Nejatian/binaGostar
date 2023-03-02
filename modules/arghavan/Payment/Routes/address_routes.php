<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Payment\Http\Controllers\AddressController::class)
    ->middleware('auth:api')->group(function ($router){

        $router->get('/address','index')->name('address');
        $router->post('/address','store')->name('address.store');
        $router->get('/address/edit/{id}','edit')->name('address.edit');
        $router->patch('/address/update/{id}','update')->name('address.update');
        $router->delete('/address/delete/{id}','destroy')->name('address.delete');
        $router->get('/factor/{id}','factor')->name('factor');
        $router->get('/buy/{id}','buy')->name('buy');
    });


