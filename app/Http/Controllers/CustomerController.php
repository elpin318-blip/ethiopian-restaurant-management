<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('customer.orders', compact('orders'));
    }
    
    // PASTE THE requestCancellation METHOD HERE
    public function requestCancellation(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Check if order belongs to this customer
        if ($order->user_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }
        
        // Only pending orders can be cancelled by customer
        if ($order->status != 'pending') {
            return response()->json(['success' => false, 'message' => 'Order cannot be cancelled']);
        }
        
        $order->cancellation_reason = 'Customer request: ' . $request->reason;
        $order->cancelled_by = auth()->user()->name . ' (Customer)';
        $order->cancelled_at = now();
        $order->status = 'cancelled';
        $order->save();
        
        // Free the table
        $table = Table::find($order->table_id);
        if ($table) {
            $table->is_occupied = false;
            $table->save();
        }
        
        return response()->json(['success' => true, 'message' => 'Order cancelled successfully']);
    }
}