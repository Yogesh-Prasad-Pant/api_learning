<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsSuperAdmin;
use Illuminate\Http\Request;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Generates: /api/customer/*
            Route::middleware('api')
                ->prefix('customer')
                ->group(base_path('routes/customer.php'));

            // Generates: /api/admin/*
            Route::middleware('api')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            // Generates: /api/admin/*
            Route::middleware('api')
                ->prefix('superadmin')
                ->group(base_path('routes/superadmin.php'));

            // Generates: /api/payments/*
            Route::middleware('api')
                ->prefix('payments')
                ->group(base_path('routes/payment.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([ 
            'is_active' => \App\Http\Middleware\IsActiveAdmin::class,
            'super_admin' => \App\Http\Middleware\IsSuperAdmin::class,
            'assign_shop' => \App\Http\Middleware\AssignShopContext::class,]);
        $middleware->redirectTo(
        guests: fn (Request $request) => null
        );
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
        $exceptions->shouldRenderJsonWhen(function (Request $request, \Throwable $e) {
                return true;
        });
        
    })->create();
