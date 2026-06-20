<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🪑 Table Management</h1>
            <div class="flex items-center space-x-4">
                <a href="/admin/dashboard" class="hover:text-yellow-300">Dashboard</a>
                <a href="/pos" class="hover:text-yellow-300">POS</a>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">📋 All Tables</h2>
                <div>
                    <a href="/admin/tables/free-all" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mr-2" onclick="return confirm('Free all tables?')">
                        🗑️ Free All Tables
                    </a>
                    <a href="/admin/tables/create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        ➕ Add New Table
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach(\App\Models\Table::all() as $table)
                    <div class="border rounded-lg p-4 text-center
                        @if($table->is_occupied) bg-red-50 border-red-500
                        @else bg-green-50 border-green-500
                        @endif">
                        <div class="text-2xl mb-2">🪑</div>
                        <div class="font-bold">Table {{ $table->table_number }}</div>
                        <div class="text-sm">Capacity: {{ $table->capacity }}</div>
                        <div class="text-sm">Location: {{ $table->location }}</div>
                        <div class="text-sm mt-2">
                            @if($table->is_occupied)
                                <span class="text-red-600">🔴 Occupied</span>
                                <a href="/admin/tables/{{ $table->id }}/free" class="bg-blue-500 text-white text-xs px-2 py-1 rounded block mt-1 hover:bg-blue-600" onclick="return confirm('Free this table?')">
                                    Free Table
                                </a>
                            @else
                                <span class="text-green-600">✅ Free</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 text-center">
                <strong>Total: {{ \App\Models\Table::count() }} tables | 
                Free: {{ \App\Models\Table::where('is_occupied', false)->count() }} | 
                Occupied: {{ \App\Models\Table::where('is_occupied', true)->count() }}</strong>
            </div>
        </div>
    </div>
</body>
</html>