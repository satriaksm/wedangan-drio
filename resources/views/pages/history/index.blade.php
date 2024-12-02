@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
    <div class="flex flex-wrap sm:flex-nowrap gap-2 w-full">
        @if (Auth::user()->role == 1)
            <!-- Modal toggle -->
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="order-first block text-white bg-primary  hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path
                        d="M19 7h-1V2H6v5H5c-1.654 0-3 1.346-3 3v7c0 1.103.897 2 2 2h2v3h12v-3h2c1.103 0 2-.897 2-2v-7c0-1.654-1.346-3-3-3zM8 4h8v3H8V4zm8 16H8v-4h8v4zm4-3h-2v-3H6v3H4v-7c0-.551.449-1 1-1h14c.552 0 1 .449 1 1v7z">
                    </path>
                    <path d="M14 10h4v2h-4z"></path>
                </svg>
            </button>
            <!-- Date range filter -->
        @endif
        <form action="{{ route('history.index') }}" method="GET"
            class="order-3 flex justify-between bg-primary py-[1px]  ps-[1px] rounded-lg text-white text-xs items-center w-full sm:w-auto relative ">
            <div id="date-range-picker" date-rangepicker class="flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-range-start" name="start_date" type="text"
                        value="{{ request('start_date', now()->format('m/d/Y')) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date start" autocomplete="off">
                </div>
                <span class="mx-2 text-white">to</span>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-range-end" name="end_date" type="text"
                        value="{{ request('end_date', now()->format('m/d/Y')) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date end" autocomplete="off">
                </div>
            </div>
            <button type="submit"
                class=" p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:border-secondary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>

        <form action="{{ route('history.index') }}" method="GET" class="flex-1 order-2 sm:order-last">
            <div class="relative">
                <input type="text" id="search-dropdown"
                    class="w-full  text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-secondary focus:border-secondary"
                    placeholder="Cari #" name="id" value="{{ request('id') }}" />
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



    <div
        class="relative overflow-x-auto overflow-y-auto max-h-[70vh] sm:max-h-[80vh] shadow-md sm:rounded-lg mt-4 rounded-lg bg-white text-primary">
        <table class="w-full text-xs lg:text-sm text-left rtl:text-right dark:text-gray-400">
            <thead
                class="text-sm uppercase dark:bg-gray-700 dark:text-white border-b bg-primary text-white sticky top-0 z-10">
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
                    @if (Auth::user()->role === 2 && $order->user_id !== Auth::id())
                        @continue
                    @endif
                    <tr data-order-id="{{ $order->id }}"
                        class="border-b dark:border-gray-700 cursor-pointer hover:bg-secondary hover:text-white"
                        onclick="fetchOrderDetails({{ $order->id }})">
                        <td class="px-1 py-2 lg:py-4 text-center">{{ $order->id }}</td>
                        <td class="px-1 py-2 lg:px-6 lg:py-4 text-center min-w-24 max-w-16 sm:max-w-none">
                            <p class="truncate">{{ implode(', ', $order->orderItems->pluck('product.name')->toArray()) }}
                            </p>
                        </td>
                        <td class="px-1 py-2 lg:px-6 lg:py-4 text-center capitalize hidden sm:block">
                            {{ $order->payment_method }}</td>
                        <td class="px-1 py-2 lg:px-6 lg:py-4 text-center">{{ $order->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td class="px-1 py-2 lg:px-6 lg:py-4 text-center capitalize"><span
                                class="sm:hidden">{{ $order->payment_method }} : </span>Rp
                            {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (Auth::user()->role === 1)
            <div class="sticky bottom-0 left-0 right-0 flex justify-between px-4 sm:px-16 py-2 bg-primary text-white z-10">
                <h1 class="font-black text-xs sm:text-sm">Total Transaksi : {{ $orders->count() }}</h1>
                <h1 class="font-black text-xs sm:text-sm">Total Jumlah : Rp
                    {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</h1>
            </div>
        @else
            <div class="sticky bottom-0 left-0 right-0 flex justify-between px-4 sm:px-16 py-2 bg-primary text-white z-10">
                <h1 class="font-black text-xs sm:text-sm">Total Transaksi :
                    {{ $orders->where('user_id', Auth::id())->count() }}</h1>
                <h1 class="font-black text-xs sm:text-sm">Total Jumlah : Rp
                    {{ number_format($orders->where('user_id', Auth::id())->sum('total_price'), 0, ',', '.') }}</h1>
            </div>
        @endif
    </div>

    @if (Auth::user()->role == 1)
        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="fixed inset-0 bg-black opacity-50 z-40"></div>
            <div class="relative p-4 w-full max-w-2xl max-h-full z-50">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Download Laporan Transaksi
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form id="exportForm" action="{{ route('history.export') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5 space-y-4">

                            <div class="form-group">
                                <select name="filter"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required>
                                    <option value="daily">Harian</option>
                                    <option value="weekly">Mingguan</option>
                                    <option value="monthly">Bulanan</option>
                                </select>
                            </div>
                            <div class="relative max-w-sm mt-4">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input name="date" id="datepicker-actions" datepicker datepicker-buttons
                                    datepicker-autoselect-today type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                    placeholder="Pilih Tanggal" autocomplete="off" required>
                            </div>

                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 justify-center gap-4">
                            <button type="submit" name="action" value="pdf"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex items-center w-full">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                </svg>
                                Download PDF
                            </button>
                            <button type="submit" name="action" value="excel"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center w-full">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                                </svg>
                                Download Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Main modal -->
    <div data-modal-target="order-modal" id="order-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="order-modal">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                    <button type="button"
                        class="text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-primary w-full"
                        data-modal-hide="order-modal">Refund/Pengembalian</button>
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
                    <p class="text-base text-gray-500 dark:text-gray-400 capitalize">
                        Faktur: ${response.id} <br>
                        Kasir: ${response.cashier} <br>
                        Jam: ${response.date} <br>
                        Pembayaran: ${response.payment}
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
    <script>
        // Pastikan untuk mengkonversi tanggal dari format Flowbite ke format yang dibutuhkan Laravel
        document.getElementById('exportForm').addEventListener('submit', function(e) {
            const datepicker = document.getElementById('datepicker-actions');

            // Konversi format tanggal dari "MM/DD/YYYY" ke "YYYY-MM-DD"
            const inputDate = datepicker.value;
            const [month, day, year] = inputDate.split('/');
            const formattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;

            // Set value input tersembunyi
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'date';
            hiddenInput.value = formattedDate;

            this.appendChild(hiddenInput);
        });
    </script>

@endsection
