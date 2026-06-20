<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Table;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/login');
        }
        
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::sum('total');
        $totalUsers = User::count();
        $recentOrders = Order::with('table')->orderBy('created_at', 'desc')->take(10)->get();
        $foods = Food::all();
        
        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalRevenue', 'totalUsers', 'recentOrders', 'foods'));
    }

    public function orders()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/login');
        }
        
        $orders = Order::with(['table', 'user', 'items.food'])
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $completedOrders = Order::with(['table', 'user', 'items.food'])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        
        return view('admin.orders', compact('orders', 'completedOrders'));
    }

    public function tables()
    {
        $tables = Table::all();
        return view('admin.tables', compact('tables'));
    }

    public function freeAllTables()
    {
        DB::table('tables')->update(['is_occupied' => 0, 'current_order_id' => null]);
        return redirect()->back()->with('success', 'All tables are now FREE!');
    }

    public function freeTable($id)
    {
        $table = Table::findOrFail($id);
        $table->is_occupied = false;
        $table->current_order_id = null;
        $table->save();
        
        return redirect()->back()->with('success', "Table {$table->table_number} is now free!");
    }

    public function createTable()
    {
        return view('admin.create-table');
    }

    public function storeTable(Request $request)
    {
        $request->validate([
            'table_number' => 'required|string|unique:tables',
            'capacity' => 'required|integer|min:1|max:10',
            'location' => 'nullable|string'
        ]);
        
        Table::create([
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'location' => $request->location,
            'is_available' => true,
            'is_occupied' => false
        ]);
        
        return redirect('/admin/dashboard')->with('success', 'Table added successfully!');
    }

    public function orderDetails($id)
    {
        $order = Order::with(['table', 'user', 'items.food'])->findOrFail($id);
        return view('admin.order-details', compact('order'));
    }

    public function getOrderDetails($id)
    {
        $order = Order::with(['table', 'items.food', 'user'])->findOrFail($id);
        
        return response()->json([
            'id' => $order->id,
            'order_number' => $order->order_number,
            'table' => $order->table,
            'status' => $order->status,
            'total' => number_format($order->total, 2),
            'user_name' => $order->user->name,
            'created_at' => $order->created_at->format('Y-m-d H:i:s'),
            'items' => $order->items
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated!');
    }

    public function completeOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'paid';
            $order->save();
            
            $table = Table::find($order->table_id);
            if ($table) {
                $table->is_occupied = false;
                $table->current_order_id = null;
                $table->save();
            }
            
            return redirect('/admin/orders')->with('success', "Order #{$order->order_number} completed! Table is now free.");
            
        } catch (\Exception $e) {
            return redirect('/admin/orders')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->cancellation_reason = $request->reason;
        $order->cancelled_by = auth()->user()->name . ' (' . auth()->user()->role . ')';
        $order->cancelled_at = now();
        $order->save();
        
        $table = Table::find($order->table_id);
        if ($table) {
            $table->is_occupied = false;
            $table->save();
        }
        
        return response()->json(['success' => true]);
    }

    public function uploadImage(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $food->id . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('foods', $imageName, 'public');
            $food->image = $path;
            $food->save();
        }
        
        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    public function foods()
    {
        $foods = Food::all();
        return view('admin.foods', compact('foods'));
    }

   public function exportOrders()
{
    $orders = Order::with(['table', 'user', 'items.food'])->orderBy('created_at', 'desc')->get();
    
    $filename = 'orders_' . date('Y-m-d') . '.csv';
    
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Pragma' => 'no-cache',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Expires' => '0'
    ];
    
    $callback = function() use ($orders) {
        $file = fopen('php://output', 'w');
        
        // Add headers
        fputcsv($file, ['Order #', 'Table', 'Customer', 'Subtotal', 'Tax', 'Service', 'Total', 'Status', 'Payment', 'Date']);
        
        // Add data
        foreach ($orders as $order) {
            fputcsv($file, [
                $order->order_number,
                'Table ' . ($order->table->table_number ?? 'N/A'),
                $order->customer_name ?? $order->user->name ?? 'Walk-in',
                number_format($order->subtotal, 2),
                number_format($order->tax, 2),
                number_format($order->service_charge, 2),
                number_format($order->total, 2),
                $order->status,
                $order->payment_status,
                $order->created_at->format('Y-m-d H:i:s')
            ]);
        }
        
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}

    public function getReport($date)
    {
        $orders = Order::whereDate('created_at', $date)->with('table')->get();
        
        return response()->json([
            'total_orders' => $orders->count(),
            'total_revenue' => number_format($orders->sum('total'), 2),
            'avg_order' => number_format($orders->avg('total'), 2),
            'orders' => $orders->map(function($order) {
                return [
                    'order_number' => $order->order_number,
                    'time' => $order->created_at->format('H:i'),
                    'total' => number_format($order->total, 2),
                    'payment_method' => $order->payment_method
                ];
            })
        ]);
    }
}