<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\CashierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Public Routes (No Login Required)
|--------------------------------------------------------------------------
*/

// POS routes - Public access
Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
Route::post('/pos/add-to-cart', [PosController::class, 'addToCart']);
Route::post('/pos/remove-from-cart', [PosController::class, 'removeFromCart']);
Route::post('/pos/update-cart', [PosController::class, 'updateCart']);
Route::get('/pos/cart-data', [PosController::class, 'getCartData']);
Route::post('/pos/clear-cart', function() {
    session()->forget('cart');
    return response()->json(['success' => true]);
});

// DIRECT ORDER ROUTE - Creates order, table remains FREE
Route::post('/direct-order', function(Request $request) {
    $tableId = $request->table_id;
    $orderType = $request->order_type;
    $items = $request->items;
    $customerName = $request->customer_name;
    $customerPhone = $request->customer_phone;
    
    // Validate order type
    if (!$orderType) {
        return response()->json(['success' => false, 'message' => 'Please select order type']);
    }
    
    // Calculate total
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $tax = $subtotal * 0.05;
    $service = $subtotal * 0.10;
    $total = $subtotal + $tax + $service;
    
    $order = App\Models\Order::create([
        'order_number' => 'ORD-' . time(),
        'user_id' => auth()->check() ? auth()->id() : 1,
        'table_id' => $tableId,
        'order_type' => $orderType,
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
        App\Models\OrderItem::create([
            'order_id' => $order->id,
            'food_id' => $item['id'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['price'],
            'subtotal' => $item['price'] * $item['quantity']
        ]);
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Order created successfully!',
        'order_id' => $order->id,
        'total' => $total
    ]);
});

// DIRECT PAYMENT ROUTE - Marks table as OCCUPIED after payment
Route::post('/direct-payment/{orderId}', function(Request $request, $orderId) {
    $order = App\Models\Order::find($orderId);
    if (!$order) {
        return response()->json(['success' => false, 'message' => 'Order not found']);
    }
    
    $amountPaid = $request->amount_paid;
    $changeDue = $amountPaid - $order->total;
    
    $order->update([
        'payment_status' => 'paid',
        'payment_method' => $request->payment_method,
        'amount_paid' => $amountPaid,
        'change_due' => $changeDue,
        'status' => 'paid'
    ]);
    
    // MARK TABLE AS OCCUPIED AFTER PAYMENT
    DB::table('tables')->where('id', $order->table_id)->update([
        'is_occupied' => 1,
        'current_order_id' => $order->id
    ]);
    
    return response()->json([
        'success' => true,
        'change' => $changeDue
    ]);
});

// FREE TABLE WHEN CUSTOMER LEAVES
Route::post('/free-table/{id}', function($id) {
    DB::table('tables')->where('id', $id)->update([
        'is_occupied' => 0,
        'current_order_id' => null
    ]);
    return response()->json(['success' => true]);
});

// Payment routes
Route::post('/pos/payment/{order}', [PosController::class, 'processPayment']);
Route::get('/pos/receipt/{order}', [PosController::class, 'showReceipt']);
Route::get('/pos/qrcode/{order}', [PosController::class, 'generateQRCode']);

// Table management utilities
Route::get('/fix-tables', function() {
    DB::table('tables')->update(['is_occupied' => 0, 'current_order_id' => null]);
    return 'All tables have been reset to FREE! <a href="/pos">Go back to POS</a>';
});

Route::get('/force-occupy/{id}', function($id) {
    DB::table('tables')->where('id', $id)->update(['is_occupied' => 1]);
    $table = DB::table('tables')->where('id', $id)->first();
    return "Table {$table->table_number} is now OCCUPIED! <a href='/pos'>Go to POS</a>";
});

Route::get('/check-tables', function() {
    $tables = \App\Models\Table::select('id', 'table_number', 'is_occupied')->get();
    return response()->json($tables);
});

Route::get('/test-table-status', function() {
    $table = App\Models\Table::find(1);
    $table->is_occupied = 1;
    $table->save();
    return "Table 1 is now marked as OCCUPIED! <a href='/pos'>Go to POS</a>";
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role === 'cashier') {
            return redirect('/pos');
        }
        
        Auth::logout();
        return back()->withErrors(['email' => 'Invalid account type']);
    }
    
    return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
});

Route::match(['get', 'post'], '/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' ? redirect('/admin/dashboard') : redirect('/pos');
    }
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin', function() {
        return redirect('/admin/dashboard');
    });
    
    Route::get('/admin/orders', [AdminController::class, 'orders']);
    Route::get('/admin/orders/{id}/details', [AdminController::class, 'orderDetails']);
    Route::put('/admin/orders/{id}/status', [AdminController::class, 'updateStatus']);
    Route::post('/admin/orders/{id}/complete', [AdminController::class, 'completeOrder']);
    Route::post('/admin/orders/{id}/cancel', [AdminController::class, 'cancelOrder']);
    
    Route::get('/admin/tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/admin/tables/create', [AdminController::class, 'createTable']);
    Route::post('/admin/tables/store', [AdminController::class, 'storeTable']);
    Route::post('/admin/tables/{id}/free', [AdminController::class, 'freeTable']);
    Route::get('/admin/free-all-tables', [AdminController::class, 'freeAllTables']);
    
    Route::resource('/admin/foods', FoodController::class);
    Route::put('/admin/foods/{id}/stock', [FoodController::class, 'updateStock']);
    Route::post('/admin/foods/{id}/toggle', [FoodController::class, 'toggleAvailability']);
    
    Route::get('/admin/report/{date}', [AdminController::class, 'getReport']);
    Route::get('/admin/export/orders', [AdminController::class, 'exportOrders']);
    
    Route::get('/admin/settings', [AdminController::class, 'settings']);
    Route::post('/admin/settings/service-charge', [AdminController::class, 'updateServiceCharge']);
    Route::get('/admin/report/settlement', [AdminController::class, 'settlementReport']);
});

/*
|--------------------------------------------------------------------------
| Cashier Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/cashier/dashboard', [CashierController::class, 'dashboard']);
    Route::post('/cashier/shift/start', [CashierController::class, 'startShift']);
    Route::post('/cashier/shift/end', [CashierController::class, 'endShift']);
});
Route::get('/admin/tables/free-all', [AdminController::class, 'freeAllTables']);
Route::get('/admin/export/orders', [AdminController::class, 'exportOrders'])->middleware('auth');