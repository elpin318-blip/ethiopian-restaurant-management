<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['table', 'user', 'items.food'])
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        return view('admin.orders', compact('orders'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status updated!');
    }
    
    public function show($id)
    {
        $order = Order::with(['table', 'items.food'])->findOrFail($id);
        return response()->json($order);
    }
}