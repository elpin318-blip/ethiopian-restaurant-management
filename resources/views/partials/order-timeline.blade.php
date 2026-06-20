<div class="mb-6">
    <h3 class="font-bold mb-3">Order Progress</h3>
    <div class="flex items-center justify-between">
        <div class="text-center flex-1">
            <div class="w-8 h-8 rounded-full mx-auto {{ $order->created_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center text-white">1</div>
            <div class="text-sm mt-1">Order Placed</div>
            <div class="text-xs text-gray-500">{{ $order->created_at ? $order->created_at->format('H:i') : '-' }}</div>
        </div>
        <div class="flex-1 h-1 {{ $order->status != 'pending' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
        <div class="text-center flex-1">
            <div class="w-8 h-8 rounded-full mx-auto {{ $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'paid' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center text-white">2</div>
            <div class="text-sm mt-1">Preparing</div>
        </div>
        <div class="flex-1 h-1 {{ $order->status == 'ready' || $order->status == 'paid' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
        <div class="text-center flex-1">
            <div class="w-8 h-8 rounded-full mx-auto {{ $order->status == 'ready' || $order->status == 'paid' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center text-white">3</div>
            <div class="text-sm mt-1">Ready</div>
        </div>
        <div class="flex-1 h-1 {{ $order->status == 'paid' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
        <div class="text-center flex-1">
            <div class="w-8 h-8 rounded-full mx-auto {{ $order->status == 'paid' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center text-white">4</div>
            <div class="text-sm mt-1">Completed</div>
            <div class="text-xs text-gray-500">{{ $order->updated_at && $order->status == 'paid' ? $order->updated_at->format('H:i') : '-' }}</div>
        </div>
    </div>
</div>