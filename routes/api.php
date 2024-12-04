<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Registration route
Route::post('register', [AuthController::class, 'register']);

// Login route
Route::post('login', [AuthController::class, 'login']);

// Protected route that requires authentication
Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user's information
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout route (revoke API token)
    Route::post('logout', [AuthController::class, 'logout']);
});
