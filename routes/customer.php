<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerAddressController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\MarketplaceController;
use App\Http\Controllers\Customer\StorefrontController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

// Public Customer Routes
Route::post('/register', [CustomerAuthController::class, 'register']);

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::post('/forgot-password', [CustomerAuthController::class, 'forgotPassword']);
});

Route::post('/reset-password', [CustomerAuthController::class, 'resetPassword']);
Route::get('/shops/{slug}', [StorefrontController::class, 'show']);
Route::get('/marketplace/products', [MarketplaceController::class, 'index']);

// Protected Customer Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [CustomerAuthController::class, 'logout']);
    Route::get('/profile', [CustomerController::class, 'profile']);
    Route::post('/profile', [CustomerController::class, 'updateProfile']);
    Route::post('/deactivate', [CustomerController::class, 'deactivateAccount']);

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [CustomerDashboardController::class, 'index']);
        Route::get('/orders-history', [CustomerDashboardController::class, 'orderHistory']);
        Route::get('/orders-details/{orderNumber}', [CustomerDashboardController::class, 'orderDetails']);
    });

    Route::prefix('addresses')->group(function () {
        Route::get('/', [CustomerAddressController::class, 'index']);
        Route::post('/', [CustomerAddressController::class, 'store']);
        Route::put('/{customerAddress}', [CustomerAddressController::class, 'update']);
        Route::patch('/default/{customerAddress}', [CustomerAddressController::class, 'setDefault']);
        Route::delete('/{customerAddress}', [CustomerAddressController::class, 'destroy']);
        Route::get('/show/{customerAddress}', [CustomerAddressController::class, 'show']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [CustomerOrderController::class, 'index']);
        Route::post('/', [CustomerOrderController::class, 'store']);
        Route::get('/{id}', [CustomerOrderController::class, 'show']);
        Route::post('/{id}/cancel', [CustomerOrderController::class, 'requestCancel']);
        Route::post('/{id}/confirm-received', [CustomerOrderController::class, 'confirmReceived']);
        Route::post('/{id}/return', [CustomerOrderController::class, 'requestReturn']);
    });
});

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::get('/count', [CartController::class, 'count']);
    Route::put('/{id}', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
    Route::delete('/clear', [CartController::class, 'clear']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/sync', [CartController::class, 'sync']);
    });
});