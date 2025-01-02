<?php

/// app/Http/Livewire/FoodItemForm.php
namespace App\Livewire;

use App\Models\Category;
use App\Models\FoodItem;
use Livewire\Component;
use Livewire\WithFileUploads; // Make sure you use WithFileUploads for handling file uploads

class FoodItemForm extends Component
{
    use WithFileUploads; // Include this trait for handling file uploads

    public $name, $description, $price, $quantity, $image, $categories = [];
    public $categoriesList;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'categories' =>'required|array',
        'categories.*' => 'exists:categories,id',
        'image' => 'nullable|image|max:1024', // You may adjust the max size
    ];

    public function mount()
    {
        $this->categoriesList = Category::all() ?? collect(); // Default to empty collection if null
    }
    

    public function submit()
{
    $this->validate();

    $imagePath = $this->image ? $this->image->store('food_items', 'public') : null;

    $foodItem = FoodItem::create([
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
        'quantity' => $this->quantity,
        'image' => $imagePath,
    ]);

    $foodItem->categories()->attach($this->categories);

    session()->flash('message', 'Food item added successfully!');

    $this->reset(['name', 'description', 'price', 'quantity', 'image', 'categories']);
    $this->mount(); // Reinitialize $categoriesList

    $this->emit('foodItemAdded'); // Emit the event
}



    public function render()
    {
        return view('livewire.food-item-form', [
            'categoriesList' => $this->categoriesList,
        ]);
    }
}
