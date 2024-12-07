<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FoodItemController;

Route::get('/food-items', [FoodItemController::class, 'index']); // Get all food items
Route::get('/food-items/{id}', [FoodItemController::class, 'show']); // Get a specific food item
Route::post('/food-items', [FoodItemController::class, 'store']); // Create a new food item
Route::put('/food-items/{id}', [FoodItemController::class, 'update']); // Update a food item
Route::delete('/food-items/{id}', [FoodItemController::class, 'destroy']); // Delete a food item

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
