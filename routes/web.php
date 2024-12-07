<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodItemController;
use App\Models\Category;
use App\Models\FoodItem;


Route::get('/', function () {
    $categories = Category::all();
    $foodItems = FoodItem::with('categories')->get(); // Fetch all food items with their categories
    return view('fooditem', compact('categories', 'foodItems'));  // Fetch all categories from the database
    // Pass categories to the view
});
Route::get('/food-items', [FoodItemController::class, 'index'])->name('food-items.index'); // List all food items
    Route::post('/food-items', [FoodItemController::class, 'store'])->name('food-items.store'); // Add a new food item
    Route::delete('/food-items/{id}', [FoodItemController::class, 'destroy'])->name('food-items.destroy');

// Food items management routes
// Route::middleware('auth')->group(function () {
//     Route::get('/food-items', [FoodItemController::class, 'index'])->name('food-items.index'); // List all food items
//     Route::post('/food-items', [FoodItemController::class, 'store'])->name('food-items.store'); // Add a new food item
//     Route::delete('/food-items/{id}', [FoodItemController::class, 'destroy'])->name('food-items.destroy'); // Delete a food item
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
