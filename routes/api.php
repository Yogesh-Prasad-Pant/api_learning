<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Shared & Public API Routes (/api/*)
|--------------------------------------------------------------------------
*/

// Generates: /api/categories
Route::get('/categories', [CategoryController::class, 'index']);