<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">👑 Admin Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <a href="/pos" class="hover:text-yellow-300">POS</a>
                <a href="/logout" class="hover:text-yellow-300">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Total Orders</div>
                <div class="text-3xl font-bold text-red-600">{{ $totalOrders ?? 0 }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Pending Orders</div>
                <div class="text-3xl font-bold text-yellow-600">{{ $pendingOrders ?? 0 }}</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Total Revenue</div>
                <div class="text-3xl font-bold text-green-600">{{ number_format($totalRevenue ?? 0, 2) }} ETB</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-gray-500 text-sm">Total Users</div>
                <div class="text-3xl font-bold text-blue-600">{{ $totalUsers ?? 0 }}</div>
            </div>
        </div>

        <!-- Management Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Food Management Card -->
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="text-center">
                    <div class="text-5xl mb-4">🍔</div>
                    <h2 class="text-xl font-bold mb-2">Food Management</h2>
                    <p class="text-gray-600 text-sm mb-4">Add, Edit, or Delete menu items</p>
                    <a href="/admin/foods" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">
                        Manage Menu
                    </a>
                </div>
            </div>

            <!-- Orders Management Card -->
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="text-center">
                    <div class="text-5xl mb-4">📋</div>
                    <h2 class="text-xl font-bold mb-2">Order Management</h2>
                    <p class="text-gray-600 text-sm mb-4">View and update order status</p>
                    <a href="/admin/orders" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 inline-block">
                        View Orders
                    </a>
                </div>
            </div>

            <!-- Table Management Card -->
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <div class="text-center">
                    <div class="text-5xl mb-4">🪑</div>
                    <h2 class="text-xl font-bold mb-2">Table Management</h2>
                    <p class="text-gray-600 text-sm mb-4">Manage tables and free occupied tables</p>
                    <a href="/admin/tables" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600 inline-block">
                        Manage Tables
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <a href="/admin/export/orders" class="bg-purple-500 text-white px-4 py-2 rounded">📊 Export to Excel</a>
            <h2 class="text-2xl font-bold mb-4">📋 Recent Orders</h2>
            @if(isset($recentOrders) && $recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left">Order #</th>
                                <th class="p-3 text-left">Table</th>
                                <th class="p-3 text-left">Total</th>
                                <th class="p-3 text-left">Status</th>
                                <th class="p-3 text-left">Time</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr class="border-b">
                                <td class="p-3">{{ $order->order_number }}</td>
                                <td class="p-3">Table {{ $order->table->table_number }}</td>
                                <td class="p-3">{{ number_format($order->total, 2) }} ETB</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-white text-xs
                                        @if($order->status == 'pending') bg-yellow-500
                                        @elseif($order->status == 'completed') bg-green-500
                                        @else bg-blue-500
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="p-3">{{ $order->created_at->format('H:i d/m/Y') }}</td>
                                <td class="p-3">
                                    <a href="/admin/orders/{{ $order->id }}/details" class="text-blue-500 hover:underline">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No orders yet</p>
            @endif
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">📊 Daily Sales Report</h2>
        <div>
            <input type="date" id="report_date" value="{{ date('Y-m-d') }}" class="border rounded px-2 py-1">
            <button onclick="loadReport()" class="bg-blue-500 text-white px-4 py-1 rounded">View Report</button>
            <button onclick="printReport()" class="bg-green-500 text-white px-4 py-1 rounded">🖨️ Print</button>
        </div>
    </div>
    
    <div id="report_content" class="mt-4">
        <!-- Report will load here -->
    </div>
</div>
<a href="/force-occupy/2" class="bg-red-500 text-white px-4 py-2 rounded">Force Occupy Table 2</a>
<script>
function loadReport() {
    const date = document.getElementById('report_date').value;
    fetch('/admin/report/' + date)
        .then(response => response.json())
        .then(data => {
            let html = `
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="bg-gray-100 p-3 rounded text-center">
                        <div class="text-gray-600">Total Orders</div>
                        <div class="text-2xl font-bold">${data.total_orders}</div>
                    </div>
                    <div class="bg-gray-100 p-3 rounded text-center">
                        <div class="text-gray-600">Total Revenue</div>
                        <div class="text-2xl font-bold text-green-600">${data.total_revenue} ETB</div>
                    </div>
                    <div class="bg-gray-100 p-3 rounded text-center">
                        <div class="text-gray-600">Avg Order Value</div>
                        <div class="text-2xl font-bold">${data.avg_order} ETB</div>
                    </div>
                </div>
                <table class="min-w-full border">
                    <thead><tr class="bg-gray-200"><th>Order #</th><th>Time</th><th>Total</th><th>Payment</th></tr></thead>
                    <tbody>
                        ${data.orders.map(order => `
                            <tr><td>${order.order_number}</td><td>${order.time}</td><td>${order.total} ETB</td><td>${order.payment_method || 'Cash'}</td></tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
            document.getElementById('report_content').innerHTML = html;
        });
}
loadReport();

function printReport() {
    const printContent = document.getElementById('report_content').innerHTML;
    const originalContent = document.body.innerHTML;
    document.body.innerHTML = `<div class="p-8">${printContent}</div>`;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}
</script>
</body>
</html>