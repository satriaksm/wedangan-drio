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
                <a href="{{ route('product.create') }}"
                    class="bg-primary hover:bg-secondary py-2 px-3 rounded-lg text-white font-medium flex sm:text-base text-xs items-center"> <svg
                        xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-white mr-2 py-1"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                    </svg>
                    Tambah Produk</a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2">
            @foreach ($products as $product => $item)
                <div class="p-4 bg-white rounded-xl shadow items-center flex justify-between">
                    <div class="flex gap-2 items-center w-full">
                        <div class="w-full">
                            <div class="text-center flex flex-col gap-1">
                                <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}" class="w-12 h-12 sm:h-16 sm:w-16 rounded-xl mx-auto">
                                <h2 class="text-xs sm:text-base font-medium  dark:text-white">{{ $item->name }}</h2>
                                <h2 class="text-[10px] sm:text-xs font-medium  dark:text-white">{{ $item->purchase_price }} | {{ $item->selling_price }}</h2>
                            </div>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="basis-1/2  w-full rounded-xl max-h-12">
                                <a href="{{route('product.edit',$item->id)}}" class="">
                                    <button class="text-white font-bold w-full p-3 bg-yellow-200 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="w-5 h-5 md:w-6 md:h-6 mx-auto "><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                                    </button>
                                </a>
                                {{-- <a class=" font-bold bg-yellow-200 px-1" href="{{route('product.edit',$item->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="w-5 h-5 md:w-6 md:h-6 mx-auto"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                                </a> --}}
                            </div>
                            <div class="basis-1/2 bg-red-500 w-full rounded-xl h-full">
                                <form action="{{ route('product.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class=" text-white font-bold w-full p-3" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-5 h-5 md:w-6 md:h-6 mx-auto"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="relative overflow-x-auto shadow-md rounded-lg w-full">
            <table class="w-full text-xs xl:text-sm 2xl:text-base text-left rtl:text-right dark:text-gray-400">
                <thead class="text-xs xl:text-sm  2xl:text-base uppercase bg-tertiary dark:bg-gray-700 dark:text-white text-white">
                    <tr>
                        <th scope="col" class="p-1 lg:py-3 text-center max-w-10">
                            No
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            product
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
                                    <a href="{{route('product.edit',$item->id)}}"
                                        class="font-bold bg-yellow-300 hover:bg-yellow-400 text-white py-1 px-1 lg:px-3 rounded-xl  ">Edit</a>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="post">
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
        </div> --}}
    </div>
@endsection
