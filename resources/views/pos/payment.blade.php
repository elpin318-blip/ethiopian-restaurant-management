<!DOCTYPE html>
<html>
<head>
    <title>Payment - Ethiopian Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-md">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold text-center mb-4">💰 Payment</h1>
            
            <div class="border-b pb-4 mb-4">
                <p><strong>Order #:</strong> {{ $order->order_number }}</p>
                <p><strong>Table:</strong> {{ $order->table->table_number }}</p>
                <p class="text-xl font-bold text-red-600">Total: {{ number_format($order->total, 2) }} ETB</p>
            </div>
            
            <form method="POST" action="/pos/payment/{{ $order->id }}">
                @csrf
                <div class="mb-4">
                    <label class="block font-bold mb-2">Payment Method</label>
                    <select name="payment_method" class="w-full border rounded p-2" required>
                        <option value="cash">💵 Cash</option>
                        <option value="card">💳 Card</option>
                        <option value="telebirr">📱 Telebirr</option>
                        <option value="cbe_birr">🏦 CBE Birr</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block font-bold mb-2">Amount Paid</label>
                    <input type="number" name="amount_paid" step="0.01" class="w-full border rounded p-2" 
                           min="{{ $order->total }}" required>
                </div>
                
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded font-bold">
                    💵 Process Payment
                </button>
            </form>
        </div>
    </div>
</body>
</html>