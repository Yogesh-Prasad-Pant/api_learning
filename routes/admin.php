<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategoryRequestController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PayoutRequestController;

// Public Admin/Vendor Routes
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/register-request', [AdminAuthController::class, 'registerRequest']);
    Route::post('/login', [AdminAuthController::class, 'login']);
});

Route::middleware('throttle:3,1')->group(function () {
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
});

// Protected Vendor Admin Routes
Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
    Route::put('/update', [AdminAuthController::class, 'updateProfile']);
    Route::post('/update-image', [AdminAuthController::class, 'updateImage']);
    Route::delete('/delete', [AdminManagementController::class, 'deleteAdmin']);
    Route::post('/upload-kyc', [AdminAuthController::class, 'uploadKyc']);

    Route::get('/shops', [ShopController::class, 'index']);
    Route::post('/shops', [ShopController::class, 'store']);

    Route::middleware(['assign_shop'])->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/stats', [AdminDashboardController::class, 'getStats']);
            Route::get('/chart', [AdminDashboardController::class, 'getChartData']);
            Route::get('/recent-orders', [AdminDashboardController::class, 'getRecentOrders']);
            Route::get('/toggle-status', [AdminDashboardController::class, 'toggleShopStatus']);
        });

        Route::prefix('shop')->group(function () {
            Route::get('/all', [ShopController::class, 'index']);
            Route::get('/profile', [ShopController::class, 'show']);
            Route::put('/profile', [ShopController::class, 'update']);
            Route::post('/profile/branding', [ShopController::class, 'updateBranding']);
            Route::delete('/profile', [ShopController::class, 'destroy']);
            Route::delete('/profile/force', [ShopController::class, 'forceDelete']);

            Route::get('/payout-requests', [PayoutRequestController::class, 'index']);
            Route::post('/payout-requests', [PayoutRequestController::class, 'store']);

            Route::prefix('category-requests')->group(function () {
                Route::get('/my-requests', [CategoryRequestController::class, 'myShopRequest'])->name('shop.category-requests.my-requests');
                Route::post('/', [CategoryRequestController::class, 'store'])->name('shop.category-requests.store');
                Route::put('/{id}', [CategoryRequestController::class, 'update'])->name('shop.category-requests.update');
                Route::delete('/{id}', [CategoryRequestController::class, 'destroy'])->name('shop.category-requests.destroy');
            });

            Route::prefix('orders')->group(function () {
                Route::get('/', [AdminOrderController::class, 'index']);
                Route::get('/{id}', [AdminOrderController::class, 'show']);
                Route::patch('/{id}/status', [AdminOrderController::class, 'updateStatus']);

                Route::post('/{id}/approve-cancellation', [AdminOrderController::class, 'approveCancellation']);
                Route::post('/{id}/reject-cancellation', [AdminOrderController::class, 'rejectCancellation']);
                Route::post('/{id}/process-return', [AdminOrderController::class, 'processReturn']);
            });
        });

        Route::prefix('products')->group(function () {
            Route::post('/store', [ProductController::class, 'store']);
            Route::get('/all', [ProductController::class, 'index']);
            Route::get('/single/{product_id}', [ProductController::class, 'getProduct']);

            Route::put('/local/{id}', [ProductController::class, 'updateShopProduct']);
            Route::post('/local/image/{product_id}', [ProductController::class, 'updateProductImage']);
            Route::delete('/local/{product_id}', [ProductController::class, 'deleteShopProduct']);
            Route::delete('/local/force-delete/{product_id}', [ProductController::class, 'forceDeleteShopProduct']);

            Route::put('/global/{product_id}', [ProductController::class, 'updateGlobalProduct']);
            Route::post('/global/image/{product_id}', [ProductController::class, 'updateCatalogImage']);
            Route::delete('/global/{product_id}', [ProductController::class, 'deleteGlobalProduct']);
            Route::delete('/global/force-delete/{product_id}', [ProductController::class, 'forceDeleteGlobalProduct']);
        });
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/index', [AdminDashboardController::class, 'index']);
    });
});