<!DOCTYPE html>
<html>
<head>
    <title>Receipt - Ethiopian Restaurant</title>
    <style>
        body { font-family: monospace; padding: 20px; }
        .receipt { max-width: 300px; margin: 0 auto; }
        .text-center { text-align: center; }
        .border-top { border-top: 1px dashed #000; margin: 10px 0; }
        .border-bottom { border-bottom: 1px dashed #000; margin: 10px 0; }
        .total { font-size: 18px; font-weight: bold; }
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="text-center">
            <h2>🇪🇹 Ethiopian Restaurant</h2>
            <p>Authentic Ethiopian Cuisine</p>
            <p>{{ date('Y-m-d H:i:s') }}</p>
            <p>Order #: {{ $order->order_number }}</p>
            <p>Table: {{ $order->table->table_number }}</p>
            <div class="border-bottom"></div>
        </div>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->food->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-top">
                    <td colspan="3" class="text-right">Subtotal:</td>
                    <td class="text-right">{{ number_format($order->subtotal, 2) }} ETB</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Tax (5%):</td>
                    <td class="text-right">{{ number_format($order->tax, 2) }} ETB</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Service (10%):</td>
                    <td class="text-right">{{ number_format($order->service_charge, 2) }} ETB</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right total">TOTAL:</td>
                    <td class="text-right total">{{ number_format($order->total, 2) }} ETB</td>
                </tr>
                @if(isset($amountPaid))
                <tr>
                    <td colspan="3" class="text-right">Amount Paid:</td>
                    <td class="text-right">{{ number_format($amountPaid, 2) }} ETB</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Change:</td>
                    <td class="text-right text-green-600">{{ number_format($changeDue, 2) }} ETB</td>
                </tr>
                @endif
            </tfoot>
        </table>

        <div class="text-center border-top">
            <p>Payment Method: {{ ucfirst($order->payment_method ?? 'Cash') }}</p>
            <p>Thank you for dining with us!</p>
            <p>🇪🇹 እንኳን ደስ አለዎት! 🇪🇹</p>
        </div>
    </div>
    
    <div class="no-print text-center" style="margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px;">🖨️ Print</button>
        <button onclick="window.close()" style="padding: 10px 20px;">Close</button>
    </div>
</body>
</html>