<?php

namespace App\Livewire;

use App\Models\FoodItem;
use Livewire\Component;

class FoodItemList extends Component
{
    public $foodItemId, $name, $description, $price, $quantity, $image;

    // Declare the foodItems property
    public $foodItems;

    protected $listeners = ['foodItemAdded' => 'refreshFoodItems'];

    public function refreshFoodItems()
    {
        // Update the component's foodItems property with fresh data
        $this->foodItems = FoodItem::all();
    }

    public function render()
    {
        // Load food items into the component
        $this->foodItems = FoodItem::all();

        return view('livewire.food-item-list', [
            'foodItems' => $this->foodItems
        ]);
    }

    // Method to delete a food item
    public function deleteFoodItem($id)
    {
        $foodItem = FoodItem::find($id);

        if ($foodItem) {
            $foodItem->delete();
            session()->flash('message', 'Food item deleted successfully.');
            $this->refreshFoodItems(); // Refresh the food items list
        } else {
            session()->flash('error', 'Food item not found.');
        }
    }

    // Method to load food item data for editing
    public function editFoodItem($id)
    {
        $foodItem = FoodItem::find($id);

        if ($foodItem) {
            $this->foodItemId = $foodItem->id;
            $this->name = $foodItem->name;
            $this->description = $foodItem->description;
            $this->price = $foodItem->price;
            $this->quantity = $foodItem->quantity;
            $this->image = $foodItem->image;
        }
    }

    // Method to update food item
    public function updateFoodItem()
    {
        $foodItem = FoodItem::find($this->foodItemId);

        if ($foodItem) {
            $foodItem->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'image' => $this->image,
            ]);

            session()->flash('message', 'Food item updated successfully.');
            $this->refreshFoodItems(); // Refresh the food items list
        } else {
            session()->flash('error', 'Food item not found.');
        }
    }
}
