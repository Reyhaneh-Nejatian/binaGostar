<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(\arghavan\Front\Http\Controllers\FrontController::class)
    ->middleware('web')->group(function ($router){

        $router->get('/','index')->name('/');
        $router->get('/single/{id}','singleProduct')->name('singleProduct');
        $router->get('/product/{slug}','product')->name('product');
        $router->get('/add-to-cart/{id}', 'addToCart')->name('addToCart');
        $router->post('/add-cart/', 'addCart')->name('addCart');
        $router->get('/low-from-cart/{id}', 'removeCart')->name('removeCart');
        $router->get('/remove-from-cart/{id}', 'remove')->name('remove');
        $router->get('/cart', 'cart')->name('cart');
    });






