<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-green-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">💰 Cashier Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <a href="/pos" class="hover:text-yellow-300">🛒 POS System</a>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Today's Orders</div>
                <div class="text-3xl font-bold text-green-600">{{ $todayOrders }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Today's Revenue</div>
                <div class="text-3xl font-bold text-blue-600">{{ number_format($todayRevenue, 2) }} ETB</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Pending Payments</div>
                <div class="text-3xl font-bold text-yellow-600">{{ $pendingPayments }}</div>
            </div>
        </div>

        <!-- Today's Transactions Table -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">📋 Today's Transactions</h2>
                <p class="text-gray-500">{{ date('F j, Y') }}</p>
            </div>

            @if($todayTransactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left">Order #</th>
                                <th class="p-3 text-left">Table</th>
                                <th class="p-3 text-left">Total</th>
                                <th class="p-3 text-left">Payment Method</th>
                                <th class="p-3 text-left">Amount Paid</th>
                                <th class="p-3 text-left">Change</th>
                                <th class="p-3 text-left">Time</th>
                                <th class="p-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayTransactions as $transaction)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-mono text-sm">{{ $transaction->order_number }}</td>
                                <td class="p-3">Table {{ $transaction->table->table_number }}</td>
                                <td class="p-3 font-bold">{{ number_format($transaction->total, 2) }} ETB</td>
                                <td class="p-3">
                                    @if($transaction->payment_method)
                                        @if($transaction->payment_method == 'cash')
                                            💵 Cash
                                        @elseif($transaction->payment_method == 'card')
                                            💳 Card
                                        @elseif($transaction->payment_method == 'telebirr')
                                            📱 Telebirr
                                        @elseif($transaction->payment_method == 'cbe_birr')
                                            🏦 CBE Birr
                                        @else
                                            {{ ucfirst($transaction->payment_method) }}
                                        @endif
                                    @else
                                        <span class="text-red-500">Pending</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ number_format($transaction->amount_paid ?? 0, 2) }} ETB</td>
                                <td class="p-3">{{ number_format($transaction->change_due ?? 0, 2) }} ETB</td>
                                <td class="p-3 text-sm">{{ $transaction->created_at->format('H:i:s') }}</td>
                                <td class="p-3">
                                    @if($transaction->payment_status == 'paid')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">✓ Paid</span>
                                    @else
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <td colspan="2" class="p-3 font-bold">Total Today:</td>
                                <td class="p-3 font-bold text-green-600">{{ number_format($todayRevenue, 2) }} ETB</td>
                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No transactions today</p>
            @endif
        </div>
    </div>
</body>
</html>