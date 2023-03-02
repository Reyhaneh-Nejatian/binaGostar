<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\User\Http\Controllers\UserController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->post('/users/photo','updatePhoto')->name('users.photo');
        $router->get('/edit-profile-admin',['uses' => 'profile', 'as' => 'admin.profile']);
        $router->post('/edit-profile-admin','updateProfile')->name('admin.updateProfile');
        $router->patch('/user/{user}/manualVerify','manualVerify')->name('users.manualVerify');
        $router->resource('/users',\arghavan\User\Http\Controllers\UserController::class);
    });


Route::namespace('arghavan\User\Http\Controllers')->middleware(['web'])->group(function ($router){

    //login
    $router->get('/admin/login',[\arghavan\User\Http\Controllers\Auth\LoginController::class,'showLoginForm']);
    $router->post('/admin/login',[\arghavan\User\Http\Controllers\Auth\LoginController::class,'login'])->name('admin.login');

    //logout
    $router->post('/admin/logout',[\arghavan\User\Http\Controllers\Auth\LoginController::class,'logout'])->name('admin.logout')->middleware('auth');
});




