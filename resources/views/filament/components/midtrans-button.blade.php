<div class="filament-forms-component">
    <button
        onclick="bayarSekarang()"
        type="button"
        class="filament-button filament-button-size-md inline-flex items-center justify-center py-2 px-4 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] bg-primary-600 text-white border-transparent hover:bg-primary-500 focus:bg-primary-500 focus:ring-offset-primary-700"
    >
        <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
        </svg>
        Bayar Formulir Pendaftaran
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    function bayarSekarang() {
        fetch('/midtrans-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            snap.pay(data.token, {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    // Kamu bisa simpan order_id di hidden input jika perlu
                },
                onPending: function(result) {
                    alert('Menunggu pembayaran...');
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                }
            });
        });
    }
</script>
