<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/home',[\Jiny\Profile\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['web', 'auth'])
    ->name('home');


Route::middleware(['web','auth'])
->prefix('account')->group(function() {
    Route::get('/', [\Jiny\Profile\Http\Controllers\AccountHome::class, 'index']);

    Route::get('/setting', [\Jiny\Profile\Http\Controllers\AccountSetting::class, 'index']);

    Route::get('/profile', [\Jiny\Profile\Http\Controllers\Profile::class, 'index']);

    Route::get('password', [\Jiny\Profile\Http\Controllers\Password::class, 'index']);

    Route::get('security', [\Jiny\Profile\Http\Controllers\Security::class, 'index']);

    Route::get('logout', [\Jiny\Profile\Http\Controllers\Logout::class, 'index']);


    /*
    Route::get('profile', 'MypageController@p');



    Route::get('billing', 'MypageController@billing');
    Route::get('notifications', 'MypageController@notifications');
    */

});
