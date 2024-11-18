@extends('layouts.cashier')
@section('title', 'Bayar')
@section('content')
<div class="flex flex-col justify-between h-[85vh]"
    x-data="{
        items: @json($items),
        total: {{ $total }},
        amount: 0,
        displayAmount: '0',
        get change() {
            return Math.max(0, this.amount - this.total);
        },
        formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        },
        formatNumber(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        },
        setAmount(value) {
            this.amount = value;
            this.displayAmount = this.formatNumber(value);
        },
        handleInput(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = parseInt(value) || 0;
            this.amount = value;
            this.displayAmount = this.formatNumber(value);
        },
        async processPayment() {
            if (this.amount < this.total) {
                alert('Jumlah pembayaran kurang dari total belanja');
                return;
            }

            try {
                const response = await fetch('{{ route('transaction.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        items: this.items,
                        total: this.total,
                        payment_amount: this.amount,
                        payment_method: 'cash'
                    })
                });

                const result = await response.json();

                if (result.success) {
                    alert('Pembayaran berhasil!\nKembalian: ' + this.formatCurrency(this.change));
                    window.location.href = '{{ route('transaction.index') }}';
                } else {
                    alert('Pembayaran gagal: ' + result.message);
                }
            } catch (error) {
                alert('Terjadi kesalahan: ' + error.message);
            }
        }
    }">

    <div>
        <button class="flex justify-between w-full px-4 py-2 bg-primary rounded-full text-white hover:bg-secondary">
            <div x-text="formatCurrency(total)"></div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </button>

        <!-- Rest of your existing payment view code -->

        <!-- Update the payment button -->
        <button
            @click="processPayment()"
            class="bg-primary w-full rounded-full text-white font-bold text-xl text-center hover:bg-secondary"
            :disabled="amount < total">
            <h3 class="py-2">Bayar</h3>
        </button>
    </div>
</div>
@endsection
