<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">🏦 Payment Settlement Report</h2>
    
    <div class="mb-4 flex gap-2">
        <input type="date" id="start_date" class="border rounded p-2">
        <input type="date" id="end_date" class="border rounded p-2">
        <button onclick="loadSettlement()" class="bg-blue-500 text-white px-4 py-2 rounded">Generate Report</button>
    </div>
    
    <div id="settlement_result"></div>
</div>

<script>
function loadSettlement() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;
    
    fetch(`/admin/report/settlement?start=${startDate}&end=${endDate}`)
        .then(response => response.json())
        .then(data => {
            let html = `
                <h3 class="font-bold text-lg mb-2">Settlement Summary: ${data.start} to ${data.end}</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="bg-gray-100 p-3 rounded"><strong>Cash:</strong> ${data.cash_total} ETB</div>
                    <div class="bg-gray-100 p-3 rounded"><strong>Telebirr:</strong> ${data.telebirr_total} ETB</div>
                    <div class="bg-gray-100 p-3 rounded"><strong>CBE Birr:</strong> ${data.cbe_total} ETB</div>
                </div>
                <table class="min-w-full border">
                    <thead><tr class="bg-gray-200"><th>Date</th><th>Transaction ID</th><th>Method</th><th>Amount</th><th>Status</th></tr></thead>
                    <tbody>
                        ${data.transactions.map(t => `<tr><td>${t.date}</td><td>${t.transaction_id}</td><td>${t.method}</td><td>${t.amount}</td><td>${t.status}</td></tr>`).join('')}
                    </tbody>
                </table>
            `;
            document.getElementById('settlement_result').innerHTML = html;
        });
}
</script>