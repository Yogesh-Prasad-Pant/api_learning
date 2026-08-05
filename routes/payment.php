<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\EsewaPaymentController;

Route::prefix('esewa')->group(function () {
    Route::post('/initiate', [EsewaPaymentController::class, 'initiate']);
    Route::get('/success', [EsewaPaymentController::class, 'success']);
    Route::get('/failure', [EsewaPaymentController::class, 'failure']);
});