<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\PayoutRequestController;
use App\Http\Controllers\Admin\CategoryRequestController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth:admin', 'super_admin'])->group(function () {
    Route::get('/super/dashboard', [AdminDashboardController::class, 'superIndex']);
    Route::get('/list', [AdminManagementController::class, 'index'])->name('admin.index');
    Route::get('/kyc/view/{id}/{type}', [AdminManagementController::class, 'viewDocument'])->name('admin.kyc.view');
    Route::post('/kyc/change-status/{id}', [AdminManagementController::class, 'changeKycStatus'])->name('admin.kyc.status');
    Route::post('/change-status/{id}', [AdminManagementController::class, 'changeStatus']);
    Route::delete('/delete/{id}', [AdminManagementController::class, 'deleteAdmin'])->name('admin.delete');
    Route::delete('/force-delete/{id}', [AdminManagementController::class, 'forceDeleteAdmin']);
    Route::post('/restore/{id}', [AdminManagementController::class, 'restoreAdmin']);

    Route::patch('/payout-requests/{id}/status', [PayoutRequestController::class, 'updateStatus']);
    Route::get('/payouts', [PayoutRequestController::class, 'index']);

    Route::prefix('category-requests')->group(function () {
        Route::get('/', [CategoryRequestController::class, 'index'])->name('admin.category-requests.index');
        Route::post('/approve/{id}', [CategoryRequestController::class, 'approve'])->name('admin.category-requests.approve');
        Route::post('/reject/{id}', [CategoryRequestController::class, 'reject'])->name('admin.category-requests.reject');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category}', [CategoryController::class, 'show']);
        Route::post('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
});