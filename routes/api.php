<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


// public route for login
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// protected routes for updating profile and  logout

Route::middleware('auth:sanctum')->group(function (){
        Route::post('/admin/logout',[AdminAuthController::class, 'logout']);
        Route::put('/admin/update',[AdminAuthController::class, 'updateProfile']);
    });
