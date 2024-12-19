<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FoodItemController;

// Registration route
Route::post('register', [AuthController::class, 'register']);

// Login route
Route::post('login', [AuthController::class, 'login']);

// Protected route that requires authentication via Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user's information
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    // Food item management routes
    Route::get('food-items', [FoodItemController::class, 'index']);  
    Route::get('food-items/{id}', [FoodItemController::class, 'show']); 
    Route::post('food-items', [FoodItemController::class, 'store']); 
    Route::put('food-items/{id}', [FoodItemController::class, 'update']); 
    Route::delete('food-items/{id}', [FoodItemController::class, 'destroy']); 

    // Logout route (revoke API token)
    Route::post('logout', [AuthController::class, 'logout']);
});
