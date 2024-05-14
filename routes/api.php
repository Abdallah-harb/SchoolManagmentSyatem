<?php

use App\Http\Controllers\Api\public\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "auth"],function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('change-password',[AuthController::class,'changePassword']);
    Route::post('forget-password',[AuthController::class,'forgetPassword']);
    Route::post('verify-email',[AuthController::class,'verifyEmail']);
    Route::post('resend-code',[AuthController::class,'resendCode']);
});
