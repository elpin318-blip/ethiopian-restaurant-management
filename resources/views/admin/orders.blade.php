<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <h1 class="text-2xl font-bold">📋 All Orders</h1>
                <a href="/admin/dashboard" class="hover:text-yellow-300">👑 Dashboard</a>
                <a href="/pos" class="hover:text-yellow-300">🛒 POS System</a>
            </div>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">{{ session('error') }}</div>
        @endif
        
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">All Orders</h2>
            
            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left">Order #</th>
                                <th class="p-3 text-left">Table</th>
                                <th class="p-3 text-left">Total</th>
                                <th class="p-3 text-left">Status</th>
                                <th class="p-3 text-left">Table Status</th>
                                <th class="p-3 text-left">Time</th>
                                <th class="p-3 text-left">Action</th>
                            </table>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-mono text-sm">{{ $order->order_number }}</td>
                                <td class="p-3">Table {{ $order->table->table_number }}</td>
                                <td class="p-3 font-bold">{{ number_format($order->total, 2) }} ETB</td>
                                <td class="p-3">
                                    <form method="POST" action="/admin/orders/{{ $order->id }}/status" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="px-2 py-1 rounded text-white text-xs
                                                @if($order->status == 'pending') bg-yellow-500
                                                @elseif($order->status == 'preparing') bg-blue-500
                                                @elseif($order->status == 'ready') bg-green-500
                                                @elseif($order->status == 'paid') bg-green-600
                                                @else bg-gray-500
                                                @endif">
                                            <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                            <option value="preparing" @if($order->status == 'preparing') selected @endif>Preparing</option>
                                            <option value="ready" @if($order->status == 'ready') selected @endif>Ready</option>
                                            <option value="paid" @if($order->status == 'paid') selected @endif>Paid</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-3">
                                    @if($order->table->is_occupied)
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">🔴 Occupied</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">✅ Free</span>
                                    @endif
                                </td>
                                <td class="p-3 text-sm">{{ $order->created_at->format('H:i d/m/Y') }}</td>
                                <td class="p-3">
                                    <div class="flex flex-col gap-1">
                                        <a href="/admin/orders/{{ $order->id }}/details" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 text-center">
                                            📋 View Details
                                        </a>
                                        @if($order->status != 'paid' && $order->status != 'cancelled')
                                            <button onclick="showCancelModal({{ $order->id }}, '{{ $order->order_number }}', '{{ $order->user->name }}')" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                                ❌ Cancel Order
                                            </button>
                                        @endif
                                        @if($order->status != 'paid' && $order->status != 'cancelled')
                                            <form method="POST" action="/admin/orders/{{ $order->id }}/complete" 
                                                  onsubmit="return confirm('Complete this order? The table will be freed.')">
                                                @csrf
                                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 w-full">
                                                    ✅ Complete Order
                                                </button>
                                            </form>
                                        @elseif($order->status == 'paid')
                                            <span class="text-gray-500 text-sm block text-center">✓ Completed</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="text-red-500 text-sm block text-center">✗ Cancelled</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No orders yet. Place an order from POS.</p>
            @endif
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <h3 class="text-xl font-bold mb-4 text-red-600">❌ Cancel Order</h3>
            <input type="hidden" id="cancel_order_id">
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Order Number</label>
                <input type="text" id="cancel_order_number" readonly class="w-full border rounded p-2 bg-gray-100">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Customer Name</label>
                <input type="text" id="cancel_customer_name" readonly class="w-full border rounded p-2 bg-gray-100">
            </div>
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Reason for cancellation</label>
                <select id="cancel_reason" class="w-full border rounded p-2">
                    <option value="Customer request - Changed mind">Customer request - Changed mind</option>
                    <option value="Customer request - Wrong order">Customer request - Wrong order</option>
                    <option value="Customer request - Long wait time">Customer request - Long wait time</option>
                    <option value="Customer request - Found cheaper elsewhere">Customer request - Found cheaper elsewhere</option>
                    <option value="Out of stock">Out of stock - Item unavailable</option>
                    <option value="Kitchen issue">Kitchen issue - Cannot prepare</option>
                    <option value="Technical error">Technical error - Duplicate order</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block font-bold mb-2">Additional Notes (Optional)</label>
                <textarea id="cancel_notes" rows="2" class="w-full border rounded p-2" placeholder="Enter additional notes..."></textarea>
            </div>
            
            <div class="flex gap-3">
                <button onclick="confirmCancel()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Confirm Cancel</button>
                <button onclick="closeCancelModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
            </div>
        </div>
    </div>

    <script>
    function showCancelModal(orderId, orderNumber, customerName) {
        document.getElementById('cancel_order_id').value = orderId;
        document.getElementById('cancel_order_number').value = orderNumber;
        document.getElementById('cancel_customer_name').value = customerName;
        document.getElementById('cancel_reason').value = 'Customer request - Changed mind';
        document.getElementById('cancel_notes').value = '';
        document.getElementById('cancelModal').classList.remove('hidden');
        document.getElementById('cancelModal').classList.add('flex');
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
        document.getElementById('cancelModal').classList.remove('flex');
    }

    function confirmCancel() {
        const orderId = document.getElementById('cancel_order_id').value;
        const reason = document.getElementById('cancel_reason').value;
        const notes = document.getElementById('cancel_notes').value;
        const fullReason = notes ? reason + ' - ' + notes : reason;
        
        if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
            fetch('/admin/orders/' + orderId + '/cancel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ reason: fullReason })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Order cancelled successfully!');
                    location.reload();
                } else {
                    alert('❌ Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error: ' + error);
            });
        }
    }
    </script>
</body>
</html>