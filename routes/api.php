<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;

Route::prefix('admin')->group(function (){

    // public route for register admin and login
        Route::middleware('throttle:5,1')->group(function ()
        {
            Route::post('/register-request',[AdminAuthController::class, 'registerRequest']);
            Route::post('/login', [AdminAuthController::class, 'login']);
        });
    // password forget/reset route
        Route::middleware('throttle:3,1')->group(function()
        {
            Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
            Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
        });
    // protected routes for viewing  searching and updating profile and  logout
        Route::middleware('auth:admin')->group(function ()
        {
            Route::post('/logout',[AdminAuthController::class, 'logout']);
            Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
            Route::put('/update',[AdminAuthController::class, 'updateProfile']);
            Route::post('/update-image',[AdminAuthController::class, 'updateImage']);
            Route::delete('/delete',[AdminManagementController::class, 'deleteAdmin']);
            Route::post('/upload-kyc', [AdminAuthController::class, 'uploadKyc']);
            Route::prefix('dashboard')->group(function()
            {
                Route::get('/index', [DashboardController::class, 'index']);
            });
            Route::get('/shops', [ShopController::class, 'index']);
            Route::post('/shops', [ShopController::class, 'store']);
            Route::middleware(['assign_shop'])->group(function ()
            {
                Route::prefix('dashboard')->group(function()
                {
                    Route::get('/stats', [DashboardController::class, 'getStats']);
                    Route::get('/chart', [DashboardController::class, 'getChartData']);
                    Route::get('/orders', [DashboardController::class, 'getRecentOrders']);
                    Route::get('/toggle-status',[DashboardController::class, 'toggleShopStatus']);
                });
                Route::prefix('shop')->group(function () 
                {
                    Route::get('/profile', [ShopController::class, 'show']);         
                    Route::put('/profile', [ShopController::class, 'update']);        
                    Route::post('/profile/branding', [ShopController::class, 'updateBranding']);   
                });
                Route::prefix('products')->group(function()
                {
                    Route::post('/store',[ProductController::class, 'store']);
                    Route::get('/all',[ProductController::class, 'index']);
                    Route::get('/{product_id}', [ProductController::class, 'getProduct']);
                    Route::put('/update/{product_id}', [ProductController::class, 'updateProduct']);
                    Route::post('/update_product_image/{product_id}', [ProductController::class, 'updateProductImage']);
                    Route::delete('/delete/{product_id}', [ProductController::class, 'deleteProduct']);
                    Route::delete('/force-delete/{product_id}',[ProductController::class, 'forceDeleteProduct']);
                });
            });
        });
    // Routes that only super_admin can access
        Route::middleware(['auth:admin','super_admin'])->group(function()
        {
            Route::get('/super/dashboard', [DashboardController::class, 'superIndex']);
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



