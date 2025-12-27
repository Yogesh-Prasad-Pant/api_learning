<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PasswordResetController;

Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
// public route for register admin
Route::post('/admin/register-request',[AdminAuthController::class, 'registerRequest'])->middleware('throttle:5,1');

// public route for login
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1');

// Routes that only super_admin can access
Route::middleware(['auth:sanctum','super_admin'])->group(function(){
        Route::get('/admin/list',[AdminAuthController::class, 'index']);
        Route::post('/admin/change-status/{id}',[AdminAuthController::class, 'changeStatus']);
});

// protected routes for viewing  searching and updating profile and  logout
Route::middleware('auth:sanctum')->group(function (){
        Route::post('/admin/logout',[AdminAuthController::class, 'logout']);
        Route::post('/admin/change-password', [AdminAuthController::class, 'changePassword']);
        Route::put('/admin/update',[AdminAuthController::class, 'updateProfile']);
        Route::post('/admin/update-image',[AdminAuthController::class, 'updateImage']);
    // route for delteing own id and super admin can only delete other id
        Route::delete('/admin/delete/{id}',[AdminAuthController::class, 'deleteAdmin']);
    });

// password forget/reset route
Route::middleware('throttle:3,1')->group(function(){
    Route::post('/admin/forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/admin/reset-password', [PasswordResetController::class, 'resetPassword']);
    });