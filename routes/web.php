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



/**
 * User Avata image
 */
//,'auth:sanctum'
Route::middleware(['web']) // , 'verified'
->prefix('account')->group(function() {
    // 사용자 아이디를 아바타 이미지 출력
    // 도메인/account/avata/{id?} 로 접속시 이미지 출력
    Route::get('avatas/{id?}', [
        \Jiny\Profile\Http\Controllers\Account\AccountAvataID::class,
        'index'])->where('id', '[0-9]+');

    // 파일명을 직접 지정하는 경우
    Route::get('avatas/{filename}', [
        \Jiny\Profile\Http\Controllers\Account\AccountAvataFile::class,
        'avata']);

    // 아바타 이미지 업로드
    Route::post('avatas/upload', [
        \Jiny\Profile\Http\Controllers\Account\AccountAvataUpload::class,
        'upload']);
});

