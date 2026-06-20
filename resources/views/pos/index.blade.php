<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>POS - Ethiopian Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-red-700 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🇪🇹 Ethiopian Restaurant - POS</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <span>Welcome, {{ auth()->user()->name }}</span>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="bg-yellow-500 text-black px-4 py-2 rounded-lg hover:bg-yellow-600">
                            👑 Admin Panel
                        </a>
                    @endif
                    
                    @if(auth()->user()->role === 'cashier')
                        <a href="/cashier/dashboard" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            💰 View Transactions
                        </a>
                    @endif
                    
                    <a href="/logout" class="hover:text-yellow-300">Logout</a>
                @else
                    <span>Welcome, Guest</span>
                    <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        🔑 Staff Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Order Type Selection - MANDATORY -->
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-white rounded-lg shadow p-4 border-2 border-red-200">
            <label class="block font-bold mb-2 text-red-700">
                Order Type <span class="text-red-500">*</span>
            </label>
            <select id="order_type" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Select Order Type --</option>
                <option value="dine_in">🏠 Dine In (Customer Present)</option>
                <option value="takeaway">📦 Takeaway (Customer Present)</option>
                <option value="delivery">🚚 Book Order From Home (Not Present)</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">⚠️ Please select order type before placing order</p>
        </div>
    </div>

    <!-- Warning message for Book Order From Home -->
    <div id="delivery_warning" class="container mx-auto px-4 mt-2 hidden">
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-2 rounded">
            📱 Book Order From Home: Customer not present. Only digital payments accepted (Telebirr, CBE Birr).
        </div>
    </div>

    <!-- Table Status Bar -->
    <div class="bg-blue-100 border-b border-blue-200 px-4 py-2 mt-4">
        <div class="container mx-auto flex justify-between items-center text-sm">
            <div class="flex space-x-6">
                <span>🪑 Total Tables: <strong>{{ $tables->count() }}</strong></span>
                <span>✅ Free Tables: <strong class="text-green-600">{{ $tables->where('is_occupied', false)->count() }}</strong></span>
                <span>🔴 Occupied Tables: <strong class="text-red-600">{{ $tables->where('is_occupied', true)->count() }}</strong></span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Menu Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold mb-4 text-red-700">🍽️ MENU</h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($foods as $food)
                            <div class="food-item bg-gray-50 border-2 rounded-lg p-4 cursor-pointer hover:shadow-lg hover:border-red-500 transition"
                                 data-id="{{ $food->id }}"
                                 data-name="{{ $food->name }}"
                                 data-price="{{ $food->price }}"
                                 @if(isset($food->stock) && $food->stock <= 0) style="opacity:0.5; pointer-events:none;" @endif>
                                <div class="w-full h-32 rounded-lg mb-3 overflow-hidden bg-gray-100">
                                    @if($food->image)
                                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
                                            <span class="text-5xl">🍽️</span>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-bold text-lg">{{ $food->name }}</h3>
                                <p class="text-gray-500 text-xs">{{ Str::limit($food->description, 40) }}</p>
                                <p class="text-red-600 font-bold text-xl mt-2">{{ number_format($food->price, 2) }} ETB</p>
                                @if(isset($food->stock) && $food->stock <= 10 && $food->stock > 0)
                                    <span class="text-orange-500 text-xs inline-block mt-1">⚠️ Low Stock: {{ $food->stock }}</span>
                                @endif
                                @if(isset($food->stock) && $food->stock <= 0)
                                    <span class="text-red-500 text-xs inline-block mt-1">❌ Out of Stock</span>
                                @endif
                                @if($food->is_spicy)
                                    <span class="text-red-500 text-xs inline-block mt-1">🌶️ Spicy</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Cart Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <h2 class="text-2xl font-bold mb-4 text-red-700">🛒 CURRENT ORDER</h2>
                    
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Select Table</label>
                        <select id="table_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- Select Table --</option>
                            @foreach($tables as $table)
                                <option value="{{ $table->id }}" @if($table->is_occupied) disabled @endif>
                                    Table {{ $table->table_number }} ({{ $table->capacity }} seats) 
                                    @if($table->is_occupied) - 🔴 OCCUPIED @else - ✅ FREE @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Customer Information Section -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-4 border-2 border-red-200">
                        <h3 class="font-bold mb-2 text-red-700">👤 Customer Information <span class="text-xs font-normal">(Required)</span></h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-bold mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="customer_name" class="w-full border rounded px-3 py-2" placeholder="Enter full name" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-1">Phone Number <span class="text-red-500">*</span></label>
                                <input type="tel" id="customer_phone" class="w-full border rounded px-3 py-2" placeholder="09XX XXX XXX" required>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">📝 We need your name and phone number for order confirmation</p>
                    </div>
                    
                    <div id="cart-items" class="max-h-96 overflow-y-auto mb-4 border rounded p-3" style="min-height: 200px;">
                        <p class="text-gray-500 text-center py-8">Cart is empty<br>Click on menu items to add</p>
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between mb-2"><span>Subtotal:</span><span id="subtotal">0.00 ETB</span></div>
                        <div class="flex justify-between mb-2 text-sm"><span>Tax (5%):</span><span id="tax">0.00 ETB</span></div>
                        <div class="flex justify-between mb-2 text-sm"><span>Service (10%):</span><span id="service">0.00 ETB</span></div>
                        <div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
                            <span>Total:</span><span id="total_amount" class="text-red-600">0.00 ETB</span>
                        </div>
                    </div>
                    
                    <button onclick="placeOrder()" id="placeOrderBtn" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold mt-4 hover:bg-green-700">
                        ✅ PLACE ORDER
                    </button>
                    
                    <button onclick="clearCart()" class="w-full bg-gray-300 text-gray-700 py-2 rounded-lg font-bold mt-2 hover:bg-gray-400">
                        🗑️ CLEAR CART
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-blue-600">💳 Complete Payment</h3>
                <button onclick="closePaymentModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            
            <div class="mb-4 p-3 bg-gray-100 rounded">
                <p class="text-sm text-gray-600">Order Total</p>
                <p class="text-2xl font-bold text-red-600" id="modal_total">0.00 ETB</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Select Payment Method</label>
                <div class="grid grid-cols-3 gap-2">
                    <button onclick="selectPaymentMethod('cash')" id="btn_cash" class="payment-method-btn border rounded p-3 text-center hover:bg-gray-100">
                        <div class="text-2xl">💵</div>
                        <div class="text-sm">Cash</div>
                    </button>
                    <button onclick="selectPaymentMethod('telebirr')" id="btn_telebirr" class="payment-method-btn border rounded p-3 text-center hover:bg-gray-100">
                        <div class="text-2xl">📱</div>
                        <div class="text-sm">Telebirr</div>
                    </button>
                    <button onclick="selectPaymentMethod('cbe_birr')" id="btn_cbe" class="payment-method-btn border rounded p-3 text-center hover:bg-gray-100">
                        <div class="text-2xl">🏦</div>
                        <div class="text-sm">CBE Birr</div>
                    </button>
                </div>
            </div>
            
            <!-- Cash Section -->
            <div id="cash_section" class="mb-4 hidden">
                <label class="block text-sm font-bold mb-2">Amount Paid (ETB)</label>
                <input type="number" id="amount_paid" step="0.01" class="w-full border rounded p-2" placeholder="Enter amount">
                <p id="change_display" class="text-sm mt-1"></p>
            </div>
            
            <!-- Telebirr QR Code Section -->
            <div id="telebirr_section" class="mb-4 hidden text-center p-3 bg-blue-50 rounded border border-blue-300">
                <p class="text-sm font-bold text-blue-800 mb-2">📱 Scan with Telebirr App</p>
                <div class="bg-white p-4 rounded inline-block">
                    <img id="telebirr_qr" src="" alt="Telebirr QR Code" class="w-48 h-48">
                </div>
                <p class="text-sm font-bold mt-2">Amount: <span id="telebirr_amount_display" class="text-blue-600">0.00</span> ETB</p>
                <p class="text-xs text-gray-600 mt-2">Merchant Code: <strong>ETH123</strong></p>
            </div>
            
            <!-- CBE Birr QR Code Section -->
            <div id="cbe_section" class="mb-4 hidden text-center p-3 bg-green-50 rounded border border-green-300">
                <p class="text-sm font-bold text-green-800 mb-2">🏦 Scan with CBE Birr App</p>
                <div class="bg-white p-4 rounded inline-block">
                    <img id="cbe_qr" src="" alt="CBE Birr QR Code" class="w-48 h-48">
                </div>
                <p class="text-sm font-bold mt-2">Amount: <span id="cbe_amount_display" class="text-green-600">0.00</span> ETB</p>
                <p class="text-xs text-gray-600 mt-2">Merchant Code: <strong>CBE789</strong></p>
            </div>
            
            <button onclick="confirmPayment()" id="confirmPaymentBtn" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold mt-4 hover:bg-green-700">
                ✅ Confirm Payment
            </button>
        </div>
    </div>

    <script>
    let cart = [];
    let currentOrderId = null;
    let currentTotal = 0;
    let selectedMethod = 'cash';

    function addToCart(id, name, price) {
        let existing = cart.find(item => item.id === id);
        if (existing) {
            existing.quantity++;
        } else {
            cart.push({ id: id, name: name, price: price, quantity: 1 });
        }
        updateCartDisplay();
        alert(name + ' added to cart!');
    }

    function updateCartDisplay() {
        const container = document.getElementById('cart-items');
        if (cart.length === 0) {
            container.innerHTML = '<p class="text-gray-500 text-center py-8">Cart is empty<br>Click on menu items to add</p>';
            document.getElementById('subtotal').innerHTML = '0.00 ETB';
            document.getElementById('tax').innerHTML = '0.00 ETB';
            document.getElementById('service').innerHTML = '0.00 ETB';
            document.getElementById('total_amount').innerHTML = '0.00 ETB';
            return;
        }

        let html = '';
        let subtotal = 0;
        cart.forEach((item, index) => {
            let itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            html += `
                <div class="border-b py-2 mb-2">
                    <div class="flex justify-between">
                        <strong>${item.name}</strong>
                        <button onclick="removeItem(${index})" class="text-red-500 text-xl">×</button>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <div>
                            <button onclick="updateQty(${index}, ${item.quantity - 1})" class="w-6 h-6 bg-gray-200 rounded">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button onclick="updateQty(${index}, ${item.quantity + 1})" class="w-6 h-6 bg-gray-200 rounded">+</button>
                        </div>
                        <span class="font-bold">${itemTotal} ETB</span>
                    </div>
                </div>
            `;
        });
        container.innerHTML = html;

        let tax = subtotal * 0.05;
        let service = subtotal * 0.10;
        let total = subtotal + tax + service;
        currentTotal = total;

        document.getElementById('subtotal').innerHTML = subtotal.toFixed(2) + ' ETB';
        document.getElementById('tax').innerHTML = tax.toFixed(2) + ' ETB';
        document.getElementById('service').innerHTML = service.toFixed(2) + ' ETB';
        document.getElementById('total_amount').innerHTML = total.toFixed(2) + ' ETB';
    }

    function updateQty(index, newQty) {
        if (newQty <= 0) {
            removeItem(index);
        } else {
            cart[index].quantity = newQty;
            updateCartDisplay();
        }
    }

    function removeItem(index) {
        cart.splice(index, 1);
        updateCartDisplay();
    }

    function clearCart() {
        if (confirm('Clear entire cart?')) {
            cart = [];
            updateCartDisplay();
        }
    }

    function selectPaymentMethod(method) {
        selectedMethod = method;
        document.getElementById('cash_section').classList.add('hidden');
        document.getElementById('telebirr_section').classList.add('hidden');
        document.getElementById('cbe_section').classList.add('hidden');
        
        const orderType = document.getElementById('order_type').value;
        
        if (orderType === 'delivery') {
            // Only digital payments for delivery
            if (method === 'telebirr') {
                document.getElementById('telebirr_section').classList.remove('hidden');
                document.getElementById('telebirr_amount_display').innerText = currentTotal.toFixed(2);
                const qrData = `telebirr://pay?merchant=ETH123&amount=${currentTotal.toFixed(2)}&ref=${Date.now()}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrData)}`;
                document.getElementById('telebirr_qr').src = qrUrl;
            } else if (method === 'cbe_birr') {
                document.getElementById('cbe_section').classList.remove('hidden');
                document.getElementById('cbe_amount_display').innerText = currentTotal.toFixed(2);
                const qrData = `cbebirr://pay?merchant=CBE789&amount=${currentTotal.toFixed(2)}&ref=${Date.now()}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrData)}`;
                document.getElementById('cbe_qr').src = qrUrl;
            }
        } else {
            // Cash and digital for dine in/takeaway
            if (method === 'cash') {
                document.getElementById('cash_section').classList.remove('hidden');
                document.getElementById('amount_paid').value = '';
                document.getElementById('change_display').innerHTML = '';
            } else if (method === 'telebirr') {
                document.getElementById('telebirr_section').classList.remove('hidden');
                document.getElementById('telebirr_amount_display').innerText = currentTotal.toFixed(2);
                const qrData = `telebirr://pay?merchant=ETH123&amount=${currentTotal.toFixed(2)}&ref=${Date.now()}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrData)}`;
                document.getElementById('telebirr_qr').src = qrUrl;
            } else if (method === 'cbe_birr') {
                document.getElementById('cbe_section').classList.remove('hidden');
                document.getElementById('cbe_amount_display').innerText = currentTotal.toFixed(2);
                const qrData = `cbebirr://pay?merchant=CBE789&amount=${currentTotal.toFixed(2)}&ref=${Date.now()}`;
                const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrData)}`;
                document.getElementById('cbe_qr').src = qrUrl;
            }
        }
        
        document.querySelectorAll('.payment-method-btn').forEach(btn => {
            btn.classList.remove('bg-blue-100', 'border-blue-500');
        });
        document.getElementById('btn_' + method).classList.add('bg-blue-100', 'border-blue-500');
    }

    function placeOrder() {
        const tableId = document.getElementById('table_id').value;
        const orderType = document.getElementById('order_type').value;
        const customerName = document.getElementById('customer_name').value;
        const customerPhone = document.getElementById('customer_phone').value;
        
        if (!orderType) {
            alert('❌ Please select an Order Type!');
            return;
        }
        
        if ((orderType === 'dine_in' || orderType === 'takeaway') && !tableId) {
            alert('❌ Please select a table!');
            return;
        }
        
        if (!customerName || customerName.trim() === '') {
            alert('❌ Please enter your name!');
            return;
        }
        
        if (!customerPhone || customerPhone.trim() === '') {
            alert('❌ Please enter your phone number!');
            return;
        }
        
        if (cart.length === 0) {
            alert('❌ Cart is empty!');
            return;
        }

        const btn = document.getElementById('placeOrderBtn');
        btn.disabled = true;
        btn.innerHTML = 'Processing...';

        fetch('/direct-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                table_id: tableId || null,
                order_type: orderType,
                customer_name: customerName,
                customer_phone: customerPhone,
                items: cart.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    quantity: item.quantity
                }))
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentOrderId = data.order_id;
                document.getElementById('modal_total').innerHTML = currentTotal.toFixed(2) + ' ETB';
                
                if (orderType === 'delivery') {
                    document.getElementById('btn_cash').style.display = 'none';
                    selectPaymentMethod('telebirr');
                } else {
                    document.getElementById('btn_cash').style.display = 'block';
                    selectPaymentMethod('cash');
                }
                
                document.getElementById('paymentModal').classList.remove('hidden');
                document.getElementById('paymentModal').classList.add('flex');
                btn.disabled = false;
                btn.innerHTML = '✅ PLACE ORDER';
            } else {
                alert('❌ Error: ' + data.message);
                btn.disabled = false;
                btn.innerHTML = '✅ PLACE ORDER';
            }
        })
        .catch(error => {
            alert('Error: ' + error);
            btn.disabled = false;
            btn.innerHTML = '✅ PLACE ORDER';
        });
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
        document.getElementById('paymentModal').classList.remove('flex');
    }

    document.getElementById('amount_paid').addEventListener('input', function() {
        const amountPaid = parseFloat(this.value);
        const total = currentTotal;
        if (!isNaN(amountPaid) && amountPaid >= total) {
            const change = amountPaid - total;
            document.getElementById('change_display').innerHTML = `<span class="text-green-600">💰 Change to return: ${change.toFixed(2)} ETB</span>`;
        } else if (!isNaN(amountPaid) && amountPaid < total) {
            document.getElementById('change_display').innerHTML = `<span class="text-red-600">⚠️ Customer still owes: ${(total - amountPaid).toFixed(2)} ETB</span>`;
        } else {
            document.getElementById('change_display').innerHTML = '';
        }
    });

    function confirmPayment() {
        let amountPaid = currentTotal;
        
        if (selectedMethod === 'cash') {
            amountPaid = parseFloat(document.getElementById('amount_paid').value);
            if (isNaN(amountPaid) || amountPaid < currentTotal) {
                alert(`Please enter amount that covers the total bill.\nTotal: ${currentTotal.toFixed(2)} ETB`);
                return;
            }
        }
        
        fetch('/direct-payment/' + currentOrderId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                payment_method: selectedMethod,
                amount_paid: amountPaid
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`✅ Payment successful! ${selectedMethod === 'cash' ? 'Change: ' + (amountPaid - currentTotal).toFixed(2) + ' ETB' : ''}`);
                location.reload();
            } else {
                alert('❌ Payment failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            alert('Error: ' + error);
        });
    }

    // Order type change handler
    document.getElementById('order_type').addEventListener('change', function() {
        const orderType = this.value;
        const cashButton = document.getElementById('btn_cash');
        
        if (orderType === 'delivery') {
            if (cashButton) cashButton.style.display = 'none';
        } else {
            if (cashButton) cashButton.style.display = 'block';
        }
    });

    document.querySelectorAll('.food-item').forEach(item => {
        item.addEventListener('click', function() {
            let id = parseInt(this.dataset.id);
            let name = this.dataset.name;
            let price = parseFloat(this.dataset.price);
            addToCart(id, name, price);
        });
    });
    </script>
</body>
</html>