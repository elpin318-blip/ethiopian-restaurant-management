<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PosController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        $foods = Food::where('is_available', true)->get();
        $tables = Table::where('is_available', true)->get();
        
        return view('pos.index', compact('categories', 'foods', 'tables'));
    }
public function checkout(Request $request)
{
    try {
        $items = $request->items;
        $tableId = $request->table_id;
        $customerName = $request->customer_name;
        $customerPhone = $request->customer_phone;
        
        if (!$tableId) {
            return response()->json(['success' => false, 'message' => 'Please select a table']);
        }
        
        if (!$items || count($items) == 0) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $tax = $subtotal * 0.05;
        $service = $subtotal * 0.10;
        $total = $subtotal + $tax + $service;
        
        // Create order WITHOUT updating table yet
        $order = Order::create([
            'order_number' => 'ORD-' . date('Ymd') . '-' . time(),
            'user_id' => auth()->check() ? auth()->id() : null,
            'table_id' => $tableId,
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'service_charge' => $service,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);
        
        // Create order items
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity']
            ]);
        }
        
        // ---------- THIS IS THE FIX ----------
        // Update table to occupied
        DB::table('tables')->where('id', $tableId)->update([
            'is_occupied' => 1,
            'current_order_id' => $order->id
        ]);
        // ------------------------------------
        
        return response()->json([
            'success' => true,
            'message' => 'Order #' . $order->order_number . ' placed successfully!',
            'order_id' => $order->id
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}

    public function processPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $amountPaid = $request->amount_paid;
        $changeDue = $amountPaid - $order->total;
        
        $order->update([
            'payment_status' => 'paid',
            'payment_method' => $request->payment_method,
            'amount_paid' => $amountPaid,
            'change_due' => $changeDue,
            'status' => 'paid'
        ]);
        
        // FREE THE TABLE
        DB::table('tables')->where('id', $order->table_id)->update([
            'is_occupied' => 0,
            'current_order_id' => null
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment successful!',
            'change' => $changeDue
        ]);
    }

    public function showReceipt($orderId)
    {
        $order = Order::with(['items.food', 'table'])->findOrFail($orderId);
        return view('pos.receipt', compact('order'));
    }
}