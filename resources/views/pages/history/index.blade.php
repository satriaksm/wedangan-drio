@extends('layouts.app')
@section('title', 'Riwayat Penjualan')
@section('content')
<<<<<<< HEAD
    <div class="flex flex-wrap sm:flex-nowrap gap-2 w-full">
        <!-- Date range tetap sama -->
        <div class="flex justify-between bg-primary p-1 rounded-xl text-white text-xs items-center w-full sm:w-auto">
            <div class="w-full lg:w-auto">
                <input type="date"
                    class="border-none bg-transparent sm:px-6 px-auto focus:ring-transparent focus:text-secondary  hover:text-secondary   text-sm w-full">
            </div>
            <div class="w-full lg:w-auto">
                <input type="date"
                    class="border-none bg-transparent sm:px-6 px-auto focus:ring-transparent focus:text-secondary  hover:text-secondary   text-sm w-full">
            </div>
        </div>

        <!-- Search section yang diperbaiki -->
        <div class="relative flex-1">
            <input type="search" id="search-dropdown"
                class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-secondary focus:border-secondary"
                placeholder="Cari #" required />
            <button type="submit"
                class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>

    <form class="max-w-3xl mx-auto fixed flex justify-center">

    </form>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 rounded-lg bg-white text-primary">
        <table class="w-full text-xs lg:text-sm text-left rtl:text-right dark:text-gray-400">
            <thead class="text-sm uppercase dark:bg-gray-700 dark:text-white border-b bg-primary text-white">
                <tr>
                    <th scope="col" class="px-1 py-2 lg:py-3 text-center capitalize">
                        #
                    </th>
                    <th scope="col" class="px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                        Barang
                    </th>
                    <th scope="col" class="lg:table-cell px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                        Tanggal
                    </th>
                    <th scope="col" class="lg:table-cell px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                        Jumlah
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($produk as $no => $item) --}}
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center min-w-8">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
=======
<div class="flex flex-wrap sm:flex-nowrap gap-2 w-full">
    <!-- Date range filter -->
    <form action="{{ route('history.index') }}" method="GET" class="flex justify-between bg-primary p-1 rounded-xl text-white text-xs items-center w-full sm:w-auto relative pe-8">
        <div class="w-full lg:w-auto">
            <input type="date" name="start_date" value="{{ request('start_date', now()->format('Y-m-d')) }}" class="border-none bg-transparent sm:px-6 px-auto focus:ring-transparent focus:text-secondary text-sm w-full pe-0">
        </div>
        <div class="w-full lg:w-auto">
            <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" class="border-none bg-transparent sm:px-6 px-auto focus:ring-transparent focus:text-secondary text-sm w-full">
        </div>
        <button type="submit"
            class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:border-secondary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <form action="{{ route('history.index') }}" method="GET" class="flex-1">
        <div class="relative">
            <input type="text" id="search-dropdown"
                class="w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-secondary focus:border-secondary"
                placeholder="Cari #" name="id" value="{{ request('id') }}"/>
            <button type="submit"
                class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:border-secondary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </form>
</div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 rounded-lg bg-white text-primary">
    <table class="w-full text-xs lg:text-sm text-left rtl:text-right dark:text-gray-400">
        <thead class="text-sm uppercase dark:bg-gray-700 dark:text-white border-b bg-primary text-white">
            <tr>
                <th scope="col" class="px-1 py-2 lg:py-3 text-center capitalize">
                    #
                </th>
                <th scope="col" class="px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                    Barang
                </th>
                <th scope="col" class="px-1 py-2 lg:px-6 lg:py-3 text-center capitalize hidden sm:block">
                    Pembayaran
                </th>
                <th scope="col" class="lg:table-cell px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                    Tanggal
                </th>
                <th scope="col" class="lg:table-cell px-1 py-2 lg:px-6 lg:py-3 text-center capitalize">
                    Jumlah
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr data-order-id="{{ $order->id }}" class="border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white" onclick="fetchOrderDetails({{ $order->id }})">
                    <td class="px-1 py-2 lg:py-4 text-center">{{ $order->id }}</td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4 text-center min-w-24 max-w-16 sm:max-w-none">
                        <p class="truncate">{{ implode(', ', $order->orderItems->pluck('product.name')->toArray()) }}</p>
>>>>>>> 0895a41c471c9608a7fa413328d6cf39751c28e0
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4 text-center capitalize hidden sm:block">{{ $order->payment_method }}</td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4 text-center">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4 text-center capitalize"><span class="sm:hidden">{{ $order->payment_method }} : </span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
<<<<<<< HEAD
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                <tr class=" dark:bg-gray-900 hover:dark:bg-gray-800  border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                    onclick="" data-modal-target="default-modal" data-modal-toggle="default-modal">
                    <td class="px-1 py-2 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center">
                        1
                    </td>
                    <td scope="row"
                        class="px-1 py-2 lg:px-6 lg:py-4 font-medium whitespace-nowrap dark:text-white text-center truncate max-w-36 text-balance">
                        Produk 1, Produk 2, Produk 3, Produk 4
                    </td>
                    <td
                        class="lg:table-cell px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center text-wrap">
                        01-10-2024 23:30
                    </td>
                    <td class="px-1 py-2 lg:px-6 lg:py-4  font-medium whitespace-nowrap dark:text-white text-center">
                        Rp 999.000
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
        <div class="flex justify-around  px-1 py-2 bg-primary text-white">
            <h1 class="font-black">Total :</h1>
            <h1 class="font-black">21</h1>
            <h1 class="font-black">Rp 123.000.000</h1>
        </div>
=======
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-between  px-4 sm:px-16 py-2 bg-primary text-white">
        <h1 class="font-black text-xs sm:text-sm">Total Transaksi : {{ $orders->count() }}</h1>
        <h1 class="font-black text-xs sm:text-sm">Total Jumlah : Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</h1>
>>>>>>> 0895a41c471c9608a7fa413328d6cf39751c28e0
    </div>


<<<<<<< HEAD
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-ful">
        <!-- Overlay Background -->
        <div class="fixed inset-0 bg-black opacity-50 z-40"></div>
        <!-- Modal Container -->
        <div class="relative p-4 w-full max-w-2xl max-h-full z-50">
            <!-- Modal content -->
            <div class="relative  rounded-lg shadow dark:bg-gray-700 bg-white">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Rincian
                    </h3>
                    <div class="flex gap-4">
                        <button
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24px"
                                class="fill-white">
                                <path
                                    d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                            </svg>
                        </button>
                        <button data-modal-target="delete-modal" data-modal-toggle="delete-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="22px"
                                class="fill-white">
                                <path
                                    d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                            </svg>
                        </button>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Faktur: 1 <br>
                        Kasir: Admin <br>
                        Jam: 01-10-2024 23:30
                    </p>
                    <table
                        class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border-t border-b dark:border-gray-600 w-full">
                        <tr>
                            <td class="py-2">1</td>
                            <td class="py-2">Nama Produk</td>
                            <td class="text-right py-2">Rp 123.000</td>
                        </tr>
                        <tr>
                            <td class="py-2">1</td>
                            <td class="py-2">Nama Produk</td>
                            <td class="text-right py-2">Rp 123.000</td>
                        </tr>
                        <tr>
                            <td class="py-2">1</td>
                            <td class="py-2">Nama Produk</td>
                            <td class="text-right py-2">Rp 123.000</td>
                        </tr>
                    </table>
                </div>
                <div class="text-center">
                    <h1 class="font-black pb-3 text-xl">Total : Rp 123.000</h1>
                </div>
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="button"
                        class="text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-primary w-full">Refund/Pengembalian</button>
                </div>
            </div>
        </div>
    </div>
=======
<!-- Main modal -->
<div data-modal-target="order-modal" id="order-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <!-- Overlay Background -->
    <div class="fixed inset-0 bg-black opacity-50 z-40"></div>
    <!-- Modal Container -->
    <div class="relative p-4 w-full max-w-2xl max-h-full z-50 mx-auto">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow dark:bg-gray-700 bg-white">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detail Penjualan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="order-modal">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4" id="order-details">
                <!-- Content will be dynamically loaded here -->
                <p class="text-base text-gray-500 dark:text-gray-400 text-center">Loading...</p>
            </div>
            <div class="text-center">
                <h1 class="font-black pb-3 text-xl" id="order-total"></h1>
            </div>
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button" class="text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-primary w-full" data-modal-hide="order-modal">Refund/Pengembalian</button>
            </div>
        </div>
    </div>
</div>
<script>
    function fetchOrderDetails(orderId) {
        // Show modal
        const modal = document.getElementById("order-modal");
        modal.classList.remove("hidden");

        // Display loading text
        const detailsContainer = document.getElementById("order-details");
        const totalContainer = document.getElementById("order-total");
        detailsContainer.innerHTML = "<p class='text-base text-gray-500 dark:text-gray-400 text-center'>Loading...</p>";
        totalContainer.innerHTML = "";

        $.ajax({
            url: '/history/' + orderId, // Route untuk mengambil data order
            method: 'GET',
            success: function(response) {
                let itemsHtml = response.items.map(item => `
                    <tr>
                        <td class="py-2">${item.quantity}</td>
                        <td class="py-2">${item.name}</td>
                        <td class="text-right py-2">Rp ${item.subtotal}</td>
                    </tr>`).join("");

                detailsContainer.innerHTML = `
                    <p class="text-base text-gray-500 dark:text-gray-400">
                        Faktur: ${response.id} <br>
                        Kasir: ${response.cashier} <br>
                        Jam: ${response.date}
                    </p>
                    <table class="text-base text-gray-500 dark:text-gray-400 border-t border-b dark:border-gray-600 w-full">
                        ${itemsHtml}
                    </table>`;
                totalContainer.innerHTML = `Total : Rp ${response.total}`;
            },
            error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.log("Response Text:", xhr.responseText);
            detailsContainer.innerHTML = `<p class="text-red-500 text-center">Error: ${error}</p>`;
        }
        });
    }

    document.querySelector('input[name="start_date"]').addEventListener('change', function() {
    const startDate = this.value;
    const endDateInput = document.querySelector('input[name="end_date"]');

    // Set minimum end date
    endDateInput.min = startDate;

    // Reset end date jika tidak valid
    if (endDateInput.value && endDateInput.value < startDate) {
        endDateInput.value = '';
    }
});
</script>

>>>>>>> 0895a41c471c9608a7fa413328d6cf39751c28e0
@endsection
