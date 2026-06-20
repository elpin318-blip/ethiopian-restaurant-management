@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold mb-6 text-red-700">Admin Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-100 rounded-lg p-6">
                <div class="text-gray-600">Total Orders</div>
                <div class="text-3xl font-bold text-red-600">{{ $totalOrders }}</div>
            </div>
            <div class="bg-gray-100 rounded-lg p-6">
                <div class="text-gray-600">Pending Orders</div>
                <div class="text-3xl font-bold text-yellow-600">{{ $pendingOrders }}</div>
            </div>
            <div class="bg-gray-100 rounded-lg p-6">
                <div class="text-gray-600">Today's Orders</div>
                <div class="text-3xl font-bold text-blue-600">{{ $todayOrders }}</div>
            </div>
            <div class="bg-gray-100 rounded-lg p-6">
                <div class="text-gray-600">Revenue</div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($totalRevenue, 2) }} ETB</div>
            </div>
        </div>
        <a href="{{ route('admin.foods.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    🍔 Manage Menu
</a>
<a href="{{ route('admin.foods.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
    🍔 Manage Menu
</a>
        <div class="text-center">
            <a href="/admin/orders" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                View All Orders
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('admin.foods.index') }}" class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600">
        <div class="text-2xl mb-2">🍔</div>
        <div class="font-bold">Manage Menu</div>
        <div class="text-sm">Add, Edit, Delete Food Items</div>
    </a>
    
    <a href="/admin/orders" class="bg-green-500 text-white p-4 rounded-lg text-center hover:bg-green-600">
        <div class="text-2xl mb-2">📋</div>
        <div class="font-bold">View Orders</div>
        <div class="text-sm">Manage customer orders</div>
    </a>
    
    <a href="/admin/tables" class="bg-purple-500 text-white p-4 rounded-lg text-center hover:bg-purple-600">
        <div class="text-2xl mb-2">🪑</div>
        <div class="font-bold">Manage Tables</div>
        <div class="text-sm">Add, Edit Tables</div>
    </a>
</div>
</div>
@endsection