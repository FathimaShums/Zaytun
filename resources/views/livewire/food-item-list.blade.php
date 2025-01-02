<div class="p-6">
    @if (session()->has('message'))
        <div class="alert alert-success mb-4 p-4 bg-green-500 text-white rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mb-4 p-4 bg-red-500 text-white rounded-md">
            {{ session('error') }}
        </div>
    @endif

    <!-- Edit Food Item Form -->
    @if($foodItemId)
        <div class="bg-white p-6 shadow-md rounded-lg mb-6">
            <h3 class="text-xl font-semibold mb-4">Edit Food Item</h3>
            <form wire:submit.prevent="updateFoodItem">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" wire:model="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium">Description</label>
                    <textarea wire:model="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium">Price</label>
                    <input type="number" wire:model="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium">Quantity</label>
                    <input type="number" wire:model="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium">Image URL</label>
                    <input type="text" wire:model="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foodItems as $foodItem)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">
                            @if ($foodItem->image)
                                <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->name }}" class="w-24 h-24 object-cover rounded-md">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $foodItem->name }}</td>
                        <td class="px-4 py-2">{{ $foodItem->description }}</td>
                        <td class="px-4 py-2">{{ $foodItem->price }}</td>
                        <td class="px-4 py-2">{{ $foodItem->quantity }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="editFoodItem({{ $foodItem->id }})" class="btn btn-info text-black bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">
                                Edit
                            </button>
                            
                            <button wire:click="deleteFoodItem({{ $foodItem->id }})" class="btn btn-danger text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
