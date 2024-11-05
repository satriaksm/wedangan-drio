@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('content')
    <div class="my-3">
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full justify-center">
            @csrf
            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama Kategori</label>
            <input type="text" id="name" name="name"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John" required />

            <button type="submit"
                class="focus:outline-none text-white bg-primary hover:bg-secondary focus:ring-4 focus:ring-green-300 font-bold rounded-lg text-sm sm:text-base px-5 py-2.5 me-2 mb-2">Simpan</button>
        </form>
    </div>
@endsection
