<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">💰 Tax & Service Charge Settings</h2>
    
    <div class="mb-4">
        <label class="block font-bold mb-2">Tax Type</label>
        <select id="tax_type" class="w-full border rounded p-2">
            @foreach($taxSettings as $tax)
                <option value="{{ $tax->percentage }}">{{ $tax->name }} ({{ $tax->percentage }}%)</option>
            @endforeach
        </select>
        <a href="/admin/tax/add" class="text-blue-500 text-sm mt-1 inline-block">+ Add new tax rate</a>
    </div>
    
    <div class="mb-4">
        <label class="block font-bold mb-2">Service Charge (%)</label>
        <input type="number" id="service_charge" step="0.5" value="{{ $serviceCharge }}" class="w-full border rounded p-2">
        <button onclick="updateServiceCharge()" class="bg-blue-500 text-white px-4 py-1 rounded mt-2">Update</button>
    </div>
</div>

<script>
function updateServiceCharge() {
    const serviceCharge = document.getElementById('service_charge').value;
    fetch('/admin/settings/service-charge', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ service_charge: serviceCharge })
    })
    .then(response => response.json())
    .then(data => {
        alert('Service charge updated to ' + serviceCharge + '%');
    });
}
</script>