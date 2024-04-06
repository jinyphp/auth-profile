<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
