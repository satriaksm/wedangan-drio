@extends('layouts.app')
@section('title', 'Tambah Users')
@section('content')
    <div class="my-3">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full justify-center">
            @csrf
            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama</label>
            <input type="text" id="name" name="name"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Raffael Aldrich S." required />

            <!-- Hidden input to set role to cashier (role ID: 2) -->
            <input type="hidden" id="role" name="role" value="2">

            <label for="email" class="block mb-2 text-sm font-medium text-black">Email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="example@gmail.com" required />

            <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
            <input type="password" id="password" name="password"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Masukkan Password" required />

            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-black">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Tulis Ulang Password" required />

            <label class="block mb-2 text-sm font-medium text-black" for="img">Upload Foto Profile</label>
            <input
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                id="img" name="img" type="file" accept="image/*" required>
            <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

            <button type="submit"
                class="focus:outline-none text-white bg-primary hover:bg-secondary focus:ring-4 focus:ring-green-300 font-bold rounded-lg text-sm sm:text-base px-5 py-2.5 me-2 mb-2">Simpan</button>
        </form>
    </div>
@endsection
