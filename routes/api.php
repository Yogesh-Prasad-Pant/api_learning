<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// public route for login
Route::post('/admin/login', [AdminAuthController::class, 'login']);
// protected routes fro logout

Route::middleware('auth:sanctum')->group(function (){
Route::post('/admin/logout',[AdminAuthController::class, 'logout'])
;});