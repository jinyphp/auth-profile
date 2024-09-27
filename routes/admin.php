<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// admin prefix 모듈 검사
if(function_exists('admin_prefix')) {
    $prefix = admin_prefix();
} else {
    $prefix = "admin";
}

## 인증 Admin
Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.auth')
->prefix($prefix.'/auth')->group(function () {
    Route::get('avata', [
        \Jiny\Profile\Http\Controllers\Admin\AdminAvataController::class,
        'index']);
});
