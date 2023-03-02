<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Payment\Http\Controllers\PaymentController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

//        $router->get('/payments','index')->name('payments.index');

        $router->get('/payments',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@index',
            "as" => ('payments.index')
        ]);

        $router->get('/orders',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@orders',
            "as" => ('orders.index')
        ]);
        $router->get('/orders/details/{id}',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@orderDetails',
            "as" => ('orderDetails')
        ]);
        $router->patch('/order/{order}/preparing',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@preparing',
            "as" => ('order.preparing')
        ]);

        $router->patch('/order/{order}/posted',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@posted',
            "as" => ('order.posted')
        ]);

        $router->patch('/order/{order}/delivered',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@delivered',
            "as" => ('order.delivered')
        ]);

        $router->get('/code/{id}',[
            "uses" => '\arghavan\Payment\Http\Controllers\PaymentController@trackingCode',
            "as" => ('payment.code')
        ]);

    });
Route::controller(\arghavan\Payment\Http\Controllers\PaymentController::class)
    ->group(function ($router){
        $router->get('/payment/callback/','callback')->name('payments.callback');
    });




