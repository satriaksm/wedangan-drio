@extends('layouts.cashier')
@section('title', 'Konfirmasi Pembayaran')
@section('content')
<div class="min-h-screen bg-gray-100 py-6">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-primary">Konfirmasi Pembayaran</h1>

        <!-- Order Details -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3">Rincian Pesanan</h2>
            <div class="space-y-2">
                @foreach($items as $item)
                    <div class="flex justify-between py-2 border-b">
                        <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                        <span>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Payment Details -->
            <div class="mt-4 pt-4 border-t">
                <div class="flex justify-between font-semibold">
                    <span>Total:</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Dibayar:</span>
                    <span>Rp {{ number_format($cashAmount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Kembalian:</span>
                    <span>Rp {{ number_format($cashAmount - $total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('transaction.index') }}"
               class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Batal
            </a>
            <button onclick="processPayment()"
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary">
                Selesaikan Pembayaran
            </button>
        </div>
    </div>
</div>

<script>
function processPayment() {
    // Format the items data correctly
    const formattedItems = @json($items).map(item => ({
        id: item.product.id,
        quantity: item.quantity,
        price: item.product.selling_price
    }));

    const data = {
        items: formattedItems,
        total: {{ $total }},
        payment_method: '{{ $paymentMethod }}',
        payment_amount: {{ $cashAmount }},
        _token: '{{ csrf_token() }}'
    };

    fetch('{{ route('transaction.process') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Pembayaran berhasil!\nKembalian: Rp ' +
                  new Intl.NumberFormat('id-ID').format({{ $cashAmount }} - {{ $total }}));
            window.location.href = '{{ route('transaction.index') }}';
        } else {
            alert('Pembayaran gagal: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan dalam pemrosesan pembayaran');
    });
}
</script>
@endsection
