<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function dashboard()
    {
        // Only cashier and admin can access
        if (auth()->user()->role !== 'cashier' && auth()->user()->role !== 'admin') {
            return redirect('/pos');
        }

        // Today's date
        $today = date('Y-m-d');
        
        // Today's orders
        $todayTransactions = Order::with('table')
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Statistics
        $todayOrders = $todayTransactions->count();
        $todayRevenue = $todayTransactions->where('payment_status', 'paid')->sum('total');
        $pendingPayments = $todayTransactions->where('payment_status', 'unpaid')->count();

        return view('cashier.dashboard', compact('todayTransactions', 'todayOrders', 'todayRevenue', 'pendingPayments'));
    }
    public function startShift(Request $request)
{
    $activeShift = CashierShift::where('user_id', auth()->id())->where('status', 'active')->first();
    if ($activeShift) {
        return redirect()->back()->with('error', 'You already have an active shift!');
    }
    
    CashierShift::create([
        'user_id' => auth()->id(),
        'login_time' => now(),
        'opening_balance' => $request->opening_balance,
        'status' => 'active'
    ]);
    
    return redirect()->back()->with('success', 'Shift started with balance: ' . $request->opening_balance . ' ETB');
}

public function endShift()
{
    $shift = CashierShift::where('user_id', auth()->id())->where('status', 'active')->first();
    if (!$shift) {
        return redirect()->back()->with('error', 'No active shift found!');
    }
    
    $todayOrders = Order::whereDate('created_at', today())->where('payment_status', 'paid')->sum('total');
    $expectedBalance = $shift->opening_balance + $todayOrders;
    
    $shift->update([
        'logout_time' => now(),
        'expected_balance' => $expectedBalance,
        'status' => 'closed',
        'closing_balance' => $request->closing_balance,
        'difference' => $request->closing_balance - $expectedBalance
    ]);
    
    return redirect()->back()->with('success', 'Shift closed!');
}
}