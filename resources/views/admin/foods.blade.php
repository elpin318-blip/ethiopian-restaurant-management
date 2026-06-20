@extends('layouts.app')

@section('title', 'Manage Foods')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold mb-6 text-red-700">🍔 Food Items Management</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($foods as $food)
            <div class="border rounded-lg p-4 hover:shadow-lg transition">
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" 
                         alt="{{ $food->name }}" 
                         class="w-full h-40 object-cover rounded-lg mb-3">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                        <span class="text-gray-400 text-4xl">🍽️</span>
                    </div>
                @endif
                
                <h3 class="font-bold text-lg">{{ $food->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $food->description }}</p>
                <p class="text-red-600 font-bold mt-2">{{ number_format($food->price, 2) }} ETB</p>
                
                <form method="POST" action="/admin/foods/{{ $food->id }}/upload-image" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <input type="file" name="image" accept="image/*" class="text-sm w-full border rounded p-1 mb-2" required>
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm w-full hover:bg-blue-600">
                        📸 Upload Image
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection