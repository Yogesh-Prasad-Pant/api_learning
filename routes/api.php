<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\AdminManagementController;

Route::prefix('admin')->group(function (){

    // public route for register admin and login
        Route::middleware('throttle:5,1')->group(function (){
            Route::post('/register-request',[AdminAuthController::class, 'registerRequest']);
            Route::post('/login', [AdminAuthController::class, 'login']);
        });
    // password forget/reset route
        Route::middleware('throttle:3,1')->group(function(){
            Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
            Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
        });
    // protected routes for viewing  searching and updating profile and  logout
        Route::middleware('auth:admin')->group(function (){
            Route::post('/logout',[AdminAuthController::class, 'logout']);
            Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
            Route::put('/update',[AdminAuthController::class, 'updateProfile']);
            Route::post('/update-image',[AdminAuthController::class, 'updateImage']);
            Route::delete('/delete',[AdminManagementController::class, 'deleteAdmin']);
            Route::post('/upload-kyc', [AdminAuthController::class, 'uploadKyc']);
            });
    // Routes that only super_admin can access
        Route::middleware(['auth:admin','super_admin'])->group(function(){
            Route::get('/list',[AdminManagementController::class, 'index'])->name('admin.index');
            Route::get('/kyc/view/{id}/{type}', [AdminManagementController::class, 'viewDocument'])->name('admin.kyc.view');
            Route::post('/kyc/change-status/{id}', [AdminManagementController::class, 'changeKycStatus'])->name('admin.kyc.status');
            Route::post('/change-status/{id}',[AdminManagementController::class, 'changeStatus']);
            Route::delete('/delete/{id}',[AdminManagementController::class, 'deleteAdmin'])->name('admin.delete');
            Route::delete('/force-delete/{id}',[AdminManagementController::class, 'forceDeleteAdmin']);
            Route::post('/restore/{id}',[AdminManagementController::class, 'restoreAdmin']);
        });

});  


Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');



