@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('content')
    <div class="container my-3">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full md:w-1/3 justify-center mx-auto">
            @csrf
            <label for="nama_produk" class="block mb-2 text-sm font-medium text-black">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John" required />

            <label for="kategori" class="block mb-2 text-sm font-medium text-black">Pilih Kategori</label>
            <select id="kategori" name="kategori"
                class="bg-gray-50 border mb-2 border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Pilih Kategori</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Camilan">Camilan</option>
            </select>

            <label for="hargabeli" class="block mb-2 text-sm font-medium text-black ">Harga Beli</label>
            <input type="number" id="hargabeli" name="harga_beli"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 2000" required />

            <label for="hargajual" class="block mb-2 text-sm font-medium text-black">Harga Jual</label>
            <input type="number" id="hargajual" name="harga_jual"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 3000" required />

            <label class="block mb-2 text-sm font-medium text-black" for="file_input">Upload file</label>
            <input
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                id="file_input" name="gambar" type="file" accept="image/*" required>
            <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

            <button type="submit"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Simpan</button>
        </form>
    </div>
@endsection
