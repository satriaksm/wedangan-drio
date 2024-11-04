@extends('layouts.app')
@section('title', 'Produk')
@section('content')
    <div class="text-primary">
        <div class="flex justify-between gap-4">
            <div class="flex-grow">
                <div class="relative">
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


            <div class="flex justify-end mb-4 items-center">
                <a href="{{ route('produk.create') }}"
                    class="bg-primary hover:bg-secondary py-2 px-3 rounded-lg text-white font-medium flex sm:text-base text-xs items-center"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-white mr-2 py-1"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                    </svg>
                    Tambah Produk</a>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md rounded-lg w-full">
            <table class="w-full text-xs xl:text-sm 2xl:text-base text-left rtl:text-right dark:text-gray-400">
                <thead class="text-xs xl:text-sm  2xl:text-base uppercase bg-tertiary dark:bg-gray-700 dark:text-white text-white">
                    <tr>
                        <th scope="col" class="p-1 lg:py-3 text-center max-w-10">
                            No
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Produk
                        </th>
                        <th scope="col" class="hidden md:table-cell p-1 lg:px-6 lg:py-3 text-center">
                            Kategori
                        </th>
                        <th scope="col" class="hidden md:table-cell p-1 lg:px-6 lg:py-3 text-center">
                            Harga Beli
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Harga Jual
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product => $item)
                        <tr
                            class="bg-white dark:bg-gray-900  border-b dark:border-gray-700">
                            <td class=" lg:py-4 font-medium  whitespace-nowrap dark:text-white text-center">
                                {{ $loop->iteration }}
                            </td>
                            <th scope="row"
                                class="p-1 lg:px-6 lg:py-4 font-medium  whitespace-nowrap dark:text-white text-center">
                                <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}"
                                class="w-10 h-10 lg:w-20 lg:h-20 object-cover mx-auto">
                                {{ $item->name }}
                            </th>
                            <td class="hidden md:table-cell p-1 lg:px-6 lg:py-4  font-medium  whitespace-nowrap dark:text-white text-center">
                                {{ $item->category->name     }}
                            </td>
                            <td class="hidden md:table-cell p-1 lg:px-6 lg:py-4  font-medium  whitespace-nowrap dark:text-white text-center">
                                {{ $item->purchase_price  }}
                            </td>
                            <td class="p-1 lg:px-6 lg:py-4  font-medium  whitespace-nowrap dark:text-white text-center">
                                {{ $item->selling_price }}
                            </td>
                            <td class="p-1 lg:px-6 lg:py-4 text-center">
                                <div class="flex items-center gap-x-2 justify-center">
                                    <a href="{{route('produk.edit',$item->id)}}"
                                        class="font-bold bg-yellow-300 hover:bg-yellow-400 text-white py-1 px-1 lg:px-3 rounded-xl  ">Edit</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="lg:px-3 py-1 px-1 bg-red-700 hover:bg-red-600 rounded-xl text-white font-bold">Delete</button>
                                </div>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
