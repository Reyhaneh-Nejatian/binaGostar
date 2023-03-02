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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'api'],function ($router){

    //register
    $router->get('/register',[\arghavan\User\Http\Controllers\Auth\Api\RegisterController::class,'showRegistrationForm'])->name('register');
    $router->post('/register',[\arghavan\User\Http\Controllers\Auth\Api\RegisterController::class,'register']);

    //login
    $router->get('/login',[\arghavan\User\Http\Controllers\Auth\Api\LoginController::class,'showLoginForm'])->name('login');
    $router->post('/login',[\arghavan\User\Http\Controllers\Auth\Api\LoginController::class,'login']);

    //logout
    $router->post('/logout',[\arghavan\User\Http\Controllers\Auth\Api\LoginController::class,'logout'])->name('logout')->middleware('auth:api');

    //verify
    $router->get('/email/verify', [\arghavan\User\Http\Controllers\Auth\Api\VerificationController::class,'show'])->name('verification.notice');
    $router->post('/email/verify', [\arghavan\User\Http\Controllers\Auth\Api\VerificationController::class,'verify'])
        ->name('verification.verify')->middleware('auth:api');
    $router->post('/email/resend',[\arghavan\User\Http\Controllers\Auth\Api\VerificationController::class,'resend'])
        ->middleware('auth:api')->name('verification.resend');

    //reset password
    $router->get('/password/reset',[\arghavan\User\Http\Controllers\Auth\Api\ForgotPasswordController::class,'showVerifyCodeRequestForm'])->name('password.request');
    $router->get('/password/reset/send',[\arghavan\User\Http\Controllers\Auth\Api\ForgotPasswordController::class,'sendVerifyCodeEmail'])->name('password.sendVerifyCodeEmail');
    $router->post('/password/reset/check-verify-code',[\arghavan\User\Http\Controllers\Auth\Api\ForgotPasswordController::class,'checkVerifyCode'])
        ->name('password.checkVerifyCode')
        ->middleware('throttle:5,1');  //در هر 1 دقیقه فقط 5 بار کد وارد کند در غیر این صورت بن میشود

    $router->get('/password/change',[\arghavan\User\Http\Controllers\Auth\Api\ResetPasswordController::class,'showResetForm'])
        ->name('password.showResetForm');

    $router->post('/password/change',[\arghavan\User\Http\Controllers\Auth\Api\ResetPasswordController::class,'reset'])
        ->name('password.update');

});
Route::middleware("auth:api")->group(function($router){
    $router->get('/test',function(){
       return "Ok";
    });
});

