@extends('layouts.app')
@section('title', 'Transaksi')
@section('content')
{{-- <div x-data="{
    products: {{ $produk->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->nama_produk,
        'price' => $item->harga_jual,
        'image' => asset('storage/products/' . $item->gambar),
        'quantity' => 0,
    ])->toJson() }},
    searchTerm: '',
    get selectedProducts() {
        return this.products.filter(p => p.quantity > 0);
    },
    get total() {
        return this.selectedProducts.reduce((sum, product) => sum + (product.price * product.quantity), 0);
    },
    getItemTotal(product) {
        return product.price * product.quantity;
    },
    formatPrice(price) {
        return price.toLocaleString('id-ID');
    }
}" class="h-screen overflow-y-auto pb-40"> --}}

    <!-- Search and Filter Section -->
    <div class="relative">
        <div class="">
            <div class="w-full">
                <input type="search" id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-tertiary focus:border-tertiary dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-tertiary"
                placeholder="Cari item" required />
            </div>
            <button type="submit"
                class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-primary">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>

    <!-- Product Categories -->
    <div class="mt-4 fixed w-[350px] md:w-full">
        <div class="md:justify-normal flex justify-between md:gap-2">
            <div class="bg-primary text-white rounded-full py-2 px-4 md:p-3 hover:bg-secondary">
                <h6 class="text-sm md:text-base">Semua</h6>
            </div>
            <div class="bg-tertiary text-white rounded-full py-2 px-4 md:p-3 hover:bg-secondary">
                <h6 class="text-sm md:text-base">Makanan</h6>
            </div>
            <div class="bg-tertiary text-white rounded-full py-2 px-3 md:p-3 hover:bg-secondary">
                <h6 class="text-sm md:text-base">Minuman</h6>
            </div>
            <div class="bg-tertiary text-white rounded-full py-2 px-3 md:p-3 hover:bg-secondary">
                <h6 class="text-sm md:text-base">Camilan</h6>
            </div>
        </div>
    </div>

    <!-- Product Grid - dengan padding bottom tambahan -->
    <div class="pt-24 grid grid-cols-2 md:grid-cols-6 gap-2 ">
        <template x-for="product in products" :key="product.id">
            <button class="container card flex mb-2 items-center bg-secondary justify-between px-3 py-2 rounded-xl"
                x-on:click="product.quantity++">
                <div class="box flex items-center gap-x-3">
                    <img :src="product.image" alt="" class="rounded size-10">
                    <div class="flex flex-col justify-between ">
                        <h1 class="menu-item dark:text-white text-white md:text-sm text-xs md:font-medium text-left" x-text="product.name"></h1>
                        <h3 class="harga dark:text-slate-300 text-white md:text-sm text-xs md:font-medium text-left">Rp<span x-text="formatPrice(product.price)"></span></h3>
                    </div>
                </div>
                <div class="hidden md:block box">
                    <div class="bg-white rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                            viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>
                    </div>
                </div>
            </button>
        </template>
    </div>

    <!-- Cart Section -->
    <div class="fixed bottom-0 left-0 right-0 px-5"
         x-show="selectedProducts.length > 0">
         <div class="rounded-t-lg p-5 mb-[75px] max-h-[40vh] flex flex-col shadow-lg bg-primary md:ms-72">
            <h2 class="font-semibold mb-3 text-white sm:mx-4">Rincian Pembelian</h2>
            <div class="overflow-y-auto flex-1 pr-2">
                <template x-for="product in selectedProducts" :key="product.id">
                    <div class="flex items-center justify-between mb-4 border-b pb-2">
                        <div class="flex-1">
                            <div class="text-sm" x-text="product.name"></div>
                            <div class="text-sm">Rp <span x-text="formatPrice(product.price)"></span></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="text-white hover:text-gray-700" x-on:click="product.quantity > 0 && product.quantity--">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <span class="w-6 text-center" x-text="product.quantity"></span>
                            <button class="text-white hover:text-gray-700" x-on:click="product.quantity++">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                        <div>
                            <div class="text-sm text-primary font-medium">Total: Rp <span x-text="formatPrice(getItemTotal(product))"></span></div>
                        </div>
                    </div>
                </template>
            </div>
         </div>
    </div>

    <!-- Bottom Bar -->
    <div class="fixed bottom-0 left-0 right-0 px-5 md:ps-[307px]">
        <div class="bg-white p-5 shadow-lg">
            <div class="sm:mx-4 flex items-center justify-between">
                <div>
                    <div class="text-sm text-primary">Total</div>
                    <div class="font-semibold text-primary">Rp <span x-text="formatPrice(total)"></span></div>
                </div>
                <button class="bg-primary hover:bg-secondary text-white px-6 py-2 rounded-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Bayar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
