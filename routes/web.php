<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/home',[\Jiny\Profile\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['web', 'auth'])
    ->name('home');


Route::middleware(['web','auth:sanctum', 'verified'])
->prefix('account')->group(function() {
    Route::get('/', [\Jiny\Profile\Http\Controllers\AccountHome::class, 'index']);

    Route::get('/setting', [\Jiny\Profile\Http\Controllers\AccountSetting::class, 'index']);

    Route::get('/profile', [\Jiny\Profile\Http\Controllers\Profile::class, 'index']);

    /*
    Route::get('profile', 'MypageController@p');

    Route::get('password', 'MypageController@password');

    Route::get('billing', 'MypageController@billing');
    Route::get('notifications', 'MypageController@notifications');
    */

});
