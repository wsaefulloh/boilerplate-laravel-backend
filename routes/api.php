<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\HealthCheckController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| All endpoints are versioned under /v1 for future compatibility.
|
*/

// Health Check Endpoint
Route::get('/health', HealthCheckController::class)->name('health.check');

// API Version 1
Route::prefix('v1')->name('v1.')->group(function () {

    // Public Auth Routes
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    // Authenticated Routes (Requires Sanctum Bearer Token)
    Route::middleware('auth:sanctum')->group(function () {

        // User Auth Profile Actions
        Route::prefix('auth')->name('auth.')->group(function () {
            Route::get('/me', [AuthController::class, 'me'])->name('me');
            Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
            Route::put('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });

        // User Management RESTful Resource Routes
        Route::apiResource('users', UserController::class);
    });
});
