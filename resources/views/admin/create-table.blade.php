<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6 text-red-700">➕ Add New Table</h1>
            
            <form method="POST" action="/admin/tables/store">
                @csrf
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Table Number</label>
                    <input type="text" name="table_number" class="w-full border rounded p-2" required>
                    <p class="text-sm text-gray-500 mt-1">Example: 16, 17, 18, etc.</p>
                </div>
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Capacity (Seats)</label>
                    <input type="number" name="capacity" class="w-full border rounded p-2" min="1" max="10" required>
                </div>
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Location</label>
                    <select name="location" class="w-full border rounded p-2">
                        <option value="Main Hall">Main Hall</option>
                        <option value="Window">Window</option>
                        <option value="VIP Room">VIP Room</option>
                        <option value="Terrace">Terrace</option>
                        <option value="Outdoor">Outdoor</option>
                    </select>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                        ✅ Add Table
                    </button>
                    <a href="/admin/dashboard" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>