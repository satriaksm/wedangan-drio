@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
    <div class="my-3">
        <form action="{{ route('product.update', $products->id) }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full justify-center ">
            @csrf
            @method('PUT') <!-- Specify that this is a PUT request -->

            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama products</label>
            <input value="{{ $products->name }}" type="text" id="name" name="name"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John" required />

            <label for="category_id" class="block mb-2 text-sm font-medium text-black">Pilih Kategori</label>
            <select id="category_id" name="category_id"
                class="bg-gray-50 border mb-2 border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ( $categories as $category)
                    <option value="{{ $category['id']}}">{{ $category['name']}}</option>
                @endforeach
            </select>

            <label for="purchase_price" class="block mb-2 text-sm font-medium text-black ">Harga Beli</label>
            <input value="{{ $products->purchase_price }}" type="number" id="purchase_price" name="purchase_price"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 2000" required />

            <input value="{{ $products->selling_price }}" type="number" id="selling_price" name="selling_price"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 3000" required />

            <label class="block mb-2 text-sm font-medium text-black" for="file_input">Upload file</label>
            <input
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                id="file_input" name="Img" type="file" accept="image/*">

            <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
            <img src="{{ asset('storage/' . $products->img) }}" alt="Img products" class="my-3 w-40 sm:w-72 h-auto mx-auto rounded-xl">

            <button type="submit"
                class="focus:outline-none text-white bg-primary hover:bg-secondary focus:ring-4 focus:ring-green-300 rounded-lg text-sm sm:text-base px-5 py-2.5 me-2 mb-2 font-bold">Simpan</button>
        </form>
    </div>
@endsection
