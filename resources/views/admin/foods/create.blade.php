<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">➕ Add New Food</h1>
            <div class="flex items-center space-x-4">
                <a href="/admin/dashboard" class="hover:text-yellow-300">Dashboard</a>
                <a href="/admin/foods" class="hover:text-yellow-300">Back to Menu</a>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-6">Add New Food Item</h2>

            <form method="POST" action="/admin/foods" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Food Name *</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Description *</label>
                    <textarea name="description" rows="3" class="w-full border rounded p-2" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Price (ETB) *</label>
                    <input type="number" name="price" step="0.01" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Category *</label>
                    <select name="category_id" class="w-full border rounded p-2" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2">Food Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center mr-4">
                        <input type="checkbox" name="is_spicy" value="1" class="mr-2">
                        <span>🌶️ Spicy</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_vegetarian" value="1" class="mr-2">
                        <span>🥬 Vegetarian</span>
                    </label>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                        💾 Save Food
                    </button>
                    <a href="/admin/foods" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>