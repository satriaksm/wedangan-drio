@extends('layouts.app')
@section('title', 'Tambah Produsk')
@section('content')
    <div class="my-3">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full justify-center">
            @csrf
            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama Produk</label>
            <input type="text" id="name" name="name"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John" required />

            <label for="category_id" class="block mb-2 text-sm font-medium text-black">Pilih Kategori</label>
            <select id="category_id" name="category_id"
                class="bg-gray-50 border mb-2 border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Pilih Kategori</option>
                <option value="1">Makanan</option>
                <option value="2">Minuman</option>
                <option value="2">Camilan</option>
            </select>

            <label for="purchase_price" class="block mb-2 text-sm font-medium text-black ">Harga Beli</label>
            <input type="number" id="purchase_price" name="purchase_price"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 2000" required />

            <label for="selling_price" class="block mb-2 text-sm font-medium text-black">Harga Jual</label>
            <input type="number" id="selling_price" name="selling_price"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 3000" required />

            <label class="block mb-2 text-sm font-medium text-black" for="img">Upload file</label>
            <input
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                id="img" name="img" type="file" accept="image/*" required>
            <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

            <button type="submit"
                class="focus:outline-none text-white bg-primary hover:bg-secondary focus:ring-4 focus:ring-green-300 font-bold rounded-lg text-sm sm:text-base px-5 py-2.5 me-2 mb-2">Simpan</button>
        </form>
    </div>
@endsection
