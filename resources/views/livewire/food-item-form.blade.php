<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4">Add Food Item</h2>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Name</label>
            <input wire:model="name" type="text" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium text-gray-700">Description</label>
            <textarea wire:model="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block font-medium text-gray-700">Price</label>
            <input wire:model="price" type="number" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block font-medium text-gray-700">Quantity</label>
            <input wire:model="quantity" type="number" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block font-medium text-gray-700">Image</label>
            <input wire:model="image" type="file" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="categories" class="block font-medium text-gray-700">Categories</label>
            <select wire:model="categories" id="categories" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
                @if ($categoriesList)
                    @foreach ($categoriesList as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @else
                    <option disabled>No categories available</option>
                @endif
            </select>
            
            @error('categories') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded shadow hover:bg-blue-700">Add Food Item</button>
    </form>
</div>
