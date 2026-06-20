@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div class="container mx-auto px-4 py-16 text-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md mx-auto">
        <div class="text-green-500 text-6xl mb-4">✓</div>
        <h1 class="text-3xl font-bold mb-4">ትዕዛዝ ተላልፏል!</h1>
        <h2 class="text-xl text-gray-600 mb-4">Order Placed Successfully!</h2>
        <p class="text-gray-600 mb-4">Your order has been sent to the kitchen.</p>
        <p class="text-gray-600 mb-8">Your order number: <strong class="text-red-600">{{ $order->order_number }}</strong></p>
        
        <div class="space-y-3">
            <a href="/pos" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
                ← አዲስ ትዕዛዝ / New Order
            </a>
            <br>
            <a href="/admin/orders" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                📋 ትዕዛዞችን ይመልከቱ / View Orders
            </a>
        </div>
    </div>
</div>
@endsection