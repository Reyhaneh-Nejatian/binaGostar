<?php

use Illuminate\Support\Facades\Route;

Route::namespace('arghavan\Category\Http\Controllers')->middleware(['web','check_auth','auth'])
    ->group(function ($router){

    $router->resource('/categories',CategoryConreoller::class);

    $router->get('/category/attribute/ajax/{category}',[\arghavan\Category\Http\Controllers\CategoryConreoller::class,'categoryAttr'])
        ->name('category.Image');
});
