<!DOCTYPE html>
<html>
<head>
    <title>Food Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-2xl font-bold">🍔 Food Management</h1>
            <div>
                <a href="/admin/dashboard" class="mr-4 hover:text-yellow-300">Dashboard</a>
                <a href="/pos" class="mr-4 hover:text-yellow-300">POS</a>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">📋 Menu Items</h2>
                <a href="/admin/foods/create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    + Add New Food
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Category</th>
                        <th class="p-3 text-left">Spicy</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                    <tr class="border-b">
                        <td class="p-3 font-bold">{{ $food->name }}</td>
                        <td class="p-3">{{ number_format($food->price, 2) }} ETB</td>
                        <td class="p-3">{{ $food->category->name ?? 'N/A' }}</td>
                        <td class="p-3">@if($food->is_spicy) 🌶️ Yes @else No @endif</td>
                        <td class="p-3">
                           <a href="/admin/foods/{{ $food->id }}/edit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 inline-block mr-1">
    ✏️ Edit
</a>
<form action="/admin/foods/{{ $food->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this food?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
        🗑️ Delete
    </button>
</form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>