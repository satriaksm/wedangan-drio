@extends('layouts.app')
@section('title', 'Produk')
@section('content')
    <div class="container">
        <div class="flex justify-end mb-4 items-center">
            <a href="{{ route('produk.create') }}"
                class="bg-slate-700 hover:bg-slate-600 py-2 px-3 rounded-lg text-white font-medium flex"> <svg
                    xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-white mr-2"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                </svg>
                Produk</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-xs lg:text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                    <tr>
                        <th scope="col" class="p-1 lg:py-3 text-center max-w-10">
                            No
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Product name
                        </th>
                        <th scope="col" class="hidden lg:table-cell p-1 lg:px-6 lg:py-3 text-center">
                            Category
                        </th>
                        <th scope="col" class="hidden lg:table-cell p-1 lg:px-6 lg:py-3 text-center">
                            Harga Beli
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Harga Jual
                        </th>
                        <th scope="col" class="p-1 lg:px-6 lg:py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product => $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class=" lg:py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                1
                            </td>
                            <th scope="row"
                                class="p-1 lg:px-6 lg:py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}"
                                class="w-10 h-10 lg:w-20 lg:h-20 object-cover mx-auto">
                                {{ $item->name }}
                            </th>
                            <td class="hidden lg:table-cell p-1 lg:px-6 lg:py-4  font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $item->category_id }}
                            </td>
                            <td class="hidden lg:table-cell p-1 lg:px-6 lg:py-4  font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $item->purchase_price  }}
                            </td>
                            <td class="p-1 lg:px-6 lg:py-4  font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{ $item->selling_price }}
                            </td>
                            <td class="p-1 lg:px-6 lg:py-4 text-center">
                                <div class="flex items-center gap-x-2 justify-center">
                                    <a href="{{route('produk.edit',$item->id)}}"
                                        class="font-normal bg-yellow-600 hover:bg-yellow-500 text-white py-1 px-1 lg:px-3 rounded-full">Edit</a>
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="lg:px-3 py-1 px-1 bg-red-700 hover:bg-red-600 rounded-full text-white font-normal">delete</button>
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
