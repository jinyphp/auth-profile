<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 관리자 프로필 라우트
 */
if(function_exists('admin_prefix')) {
    $prefix = admin_prefix();
} else {
    $prefix = "admin";
}

Route::middleware(['web','auth:sanctum', 'verified', 'admin'])
->name('admin.')
->prefix($prefix)->group(function () {
    
});




