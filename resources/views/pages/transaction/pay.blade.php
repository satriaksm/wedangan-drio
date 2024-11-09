@extends('layouts.cashier')
@section('title', 'Bayar')
@section('content')
<div class="flex flex-col justify-between h-[85vh]" x-data="{
    amount: 0,
    displayAmount: '0',
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
        // Hapus semua karakter non-digit
        let value = e.target.value.replace(/\D/g, '');

        // Convert ke number
        value = parseInt(value) || 0;

        // Update nilai
        this.amount = value;
        this.displayAmount = this.formatNumber(value);
    }
}">
    <div>
        <button class="flex justify-between w-full px-4 py-2 bg-primary rounded-full text-white hover:bg-secondary">
            <div>Rp 000.000</div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </button>

        <div class="text-center mt-4">
            <div>
                <h1 class="text-black font-black text-2xl">
                    Masukkan Jumlah Uang
                </h1>
            </div>
            <div class="bg-primary rounded-2xl py-8 text-white font-bold text-xl">
                <div>
                    <h3 class="text-xl">Jumlah Uang</h3>
                    <input
                        type="text"
                        x-model="displayAmount"
                        @input="handleInput($event)"
                        @focus="$event.target.select()"
                        class="text-2xl bg-transparent text-center w-full border-none focus:ring-transparent"
                    >
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 mt-2">
                <template x-for="value in [2000, 5000, 10000, 20000, 50000, 100000]">
                    <button
                        @click="setAmount(value)"
                        class="bg-primary px-4 py-3 rounded-xl text-white hover:bg-secondary"
                        x-text="formatCurrency(value)"
                    ></button>
                </template>
            </div>
        </div>
    </div>

    <button class="bg-primary w-full rounded-full text-white font-bold text-xl text-center hover:bg-secondary">
        <h3 class="py-2">Bayar</h3>
    </button>
</div>
@endsection
