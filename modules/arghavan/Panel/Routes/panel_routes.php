<?php
use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\Panel\Http\Controllers\PanelController::class)
    ->middleware(['auth:api'])
    ->group(function ($router){

        $router->get('/panel/user','index')->name('panel');
        $router->get('/edit-profile','profile')->name('users.profile');
        $router->post('/edit-profile','updateProfile')->name('users.updateProfile');
        $router->get('/purchases','purchases')->name('purchases.index');
        $router->get('/purchases/details/{id}','purchasesDetails')->name('purchases.details');
    });


