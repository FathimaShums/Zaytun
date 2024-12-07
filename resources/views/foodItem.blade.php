<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // JavaScript function to handle form submission
        async function addFoodItem(event) {
            event.preventDefault(); // Prevent page reload

            const formData = new FormData(event.target);
            try {
                const response = await axios.post('{{ route('food-items.store') }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json'
                    }
                });
                alert(response.data.message); // Show success message
                location.reload(); // Reload the page to fetch updated data
            } catch (error) {
                console.error(error);
                alert('Failed to add food item. Please check your input.');
            }
        }

        // JavaScript function to delete a food item
        async function deleteFoodItem(id) {
            if (!confirm('Are you sure you want to delete this item?')) return;

            try {
                const response = await axios.delete(`/food-items/${id}`);
                alert('Food item deleted successfully!');
                location.reload();
            } catch (error) {
                console.error(error);
                alert('Failed to delete food item.');
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Food Items</h1>

        <!-- Add Food Item Form -->
        <form onsubmit="addFoodItem(event)" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block font-medium text-gray-700">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700">Image</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="categories" class="block font-medium text-gray-700">Categories</label>
                <select id="categories" name="categories[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add Food Item</button>
        </form>
        @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Whoops!</strong> <span class="block sm:inline">Something went wrong.</span>
        <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- Existing Food Items -->
        <h2 class="text-xl font-bold mt-8 mb-4">Existing Food Items</h2>
        <ul class="space-y-4">
            @foreach ($foodItems as $foodItem)
                <li class="bg-white p-4 rounded shadow-md flex justify-between items-center">
                    <div>
                        <p class="font-bold">{{ $foodItem->name }}</p>
                        <p class="text-sm text-gray-500">Price: ${{ $foodItem->price }}</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $foodItem->quantity }}</p>
                    </div>
                    <button onclick="deleteFoodItem({{ $foodItem->id }})" class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-700">Delete</button>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
