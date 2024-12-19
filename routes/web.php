<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;

// Home route to display food items and categories
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Food item routes (accessible without authentication)
Route::get('/food-items', [FoodItemController::class, 'index'])->name('food-items.index'); // List all food items

// Dashboard route for authenticated users
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Include authentication routes
require __DIR__.'/auth.php';
