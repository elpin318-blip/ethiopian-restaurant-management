<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <h1 class="text-2xl font-bold">📋 Order Details</h1>
                <a href="/admin/dashboard" class="hover:text-yellow-300">Dashboard</a>
                <a href="/admin/orders" class="hover:text-yellow-300">All Orders</a>
                <a href="/pos" class="hover:text-yellow-300">POS</a>
            </div>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4 text-red-700">Order #{{ $order->order_number }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p><strong>Table Number:</strong> Table {{ $order->table->table_number }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-1 rounded text-white text-xs
                            @if($order->status == 'pending') bg-yellow-500
                            @elseif($order->status == 'preparing') bg-blue-500
                            @elseif($order->status == 'ready') bg-green-500
                            @elseif($order->status == 'paid') bg-green-600
                            @else bg-gray-500
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Ordered By:</strong> {{ $order->user->name }}</p>
                </div>
                <div>
                    <p><strong>Ordered At:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                </div>
            </div>
            
            <h3 class="text-xl font-bold mb-3">Order Items</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-3 text-left">Item</th>
                            <th class="p-3 text-left">Quantity</th>
                            <th class="p-3 text-left">Unit Price</th>
                            <th class="p-3 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="p-3">{{ $item->food->name }}</td>
                            <td class="p-3">{{ $item->quantity }}</td>
                            <td class="p-3">{{ number_format($item->unit_price, 2) }} ETB</td>
                            <td class="p-3">{{ number_format($item->subtotal, 2) }} ETB</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="p-3 text-right font-bold">Subtotal:</td>
                            <td class="p-3 font-bold">{{ number_format($order->subtotal, 2) }} ETB</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="p-3 text-right font-bold">Tax (5%):</td>
                            <td class="p-3 font-bold">{{ number_format($order->tax, 2) }} ETB</td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="p-3 text-right font-bold">Service (10%):</td>
                            <td class="p-3 font-bold">{{ number_format($order->service_charge, 2) }} ETB</td>
                        </tr>
                        <tr class="bg-red-100">
                            <td colspan="3" class="p-3 text-right font-bold text-red-700">TOTAL:</td>
                            <td class="p-3 font-bold text-red-700">{{ number_format($order->total, 2) }} ETB</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="mt-6 flex gap-3">
                <a href="/admin/dashboard" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">← Back to Dashboard</a>
                <a href="/admin/orders" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">View All Orders</a>
            </div>
        </div>
    </div>
</body>
</html>