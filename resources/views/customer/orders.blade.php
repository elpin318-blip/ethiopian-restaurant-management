@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">📋 My Orders</h1>
    
    @foreach($orders as $order)
    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-bold">Order #{{ $order->order_number }}</p>
                <p class="text-sm text-gray-600">{{ $order->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <div>
                <span class="px-2 py-1 rounded text-white text-xs bg-yellow-500">{{ ucfirst($order->status) }}</span>
            </div>
            <div>
                <p class="font-bold text-red-600">{{ number_format($order->total, 2) }} ETB</p>
            </div>
            <a href="/customer/orders/{{ $order->id }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">View</a>
        </div>
    </div>
    @endforeach
</div>
@endsection