<?php

use Illuminate\Support\Facades\Route;

Route::controller(\arghavan\RolePermissions\Http\Controllers\RolePermissionController::class)
    ->middleware(['web','check_auth','auth'])->group(function ($router){

        $router->resource('/role-permissions',\arghavan\RolePermissions\Http\Controllers\RolePermissionController::class);

    });
