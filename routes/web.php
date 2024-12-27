<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

## Home Profile 정보
## 로그인후 사용자의 정보를 확인할 수 있는 home 화면 입니다.
Route::middleware(['web','auth'])
->name('home')
->prefix('home')->group(function () {
    
});


Route::middleware(['web','auth'])
->name('home.account')
->prefix('home/account')->group(function () {
    // Route::get('/',[
    //     \Jiny\Profile\Http\Controllers\ProfileAccountController::class,
    //     'index'
    // ]);

    // Route::get('/avata',[
    //     \Jiny\Profile\Http\Controllers\ProfileAvataController::class,
    //     'index'
    // ]);

    // Route::get('/password',[
    //     \Jiny\Profile\Http\Controllers\ProfilePasswordController::class,
    //     'index'
    // ]);

    // Route::get('/social',[
    //     \Jiny\Profile\Http\Controllers\ProfileSocialController::class,
    //     'index'
    // ]);

    // Route::get('/addresses',[
    //     \Jiny\Profile\Http\Controllers\ProfileAddressesController::class,
    //     'index'
    // ]);

    // Route::get('/logout',[
    //     \Jiny\Profile\Http\Controllers\ProfileLogoutController::class,
    //     'index'
    // ]);

    // Route::get('/security',[
    //     \Jiny\Profile\Http\Controllers\ProfileSecurityController::class,
    //     'index'
    // ]);

});


