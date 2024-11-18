@extends('layouts.app')
@section('title', 'Edit Users')
@section('content')
    <div class="my-3">
        <form action="{{ route('user.update', $users->id) }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col w-full justify-center ">
            @csrf
            @method('PUT') <!-- Specify that this is a PUT request -->

            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama</label>
            <input value="{{ $users->name }}" type="text" id="name" name="name"
                class="mb-2 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="John" required />

            <label for="email" class="block mb-2 text-sm font-medium text-black ">Email</label>
            <input value="{{ $users->email }}" type="email" id="email" name="email"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Rp 2000" required />


            @error('password')
                <div class="mb-2 p-3 text-red-700 bg-red-100 rounded-lg">
                    <ul>
                        <li class="list-disc list-inside">
                            <span class="text-sm">{{ $message }}</span>
                        </li>
                    </ul>
                </div>
            @enderror
            <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
            <input type="password" id="password" name="password"
                    class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Masukkan Password Baru" />

            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-black">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="bg-gray-50 mb-2 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Tulis Ulang Password Baru"/>

            <label class="block mb-2 text-sm font-medium text-black" for="file_input">Upload Foto Profile Baru</label>
            <input
                class="block w-full text-sm text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                id="file_input" name="Img" type="file" accept="image/*">

            <p class="mt-1 text-sm text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
            <img src="{{ asset('storage/' . $users->img) }}" alt="Img user" class="my-3 w-40 sm:w-72 h-auto mx-auto rounded-xl">

            <button type="submit"
                class="focus:outline-none text-white bg-primary hover:bg-secondary focus:ring-4 focus:ring-green-300 rounded-lg text-sm sm:text-base px-5 py-2.5 me-2 mb-2 font-bold">Simpan</button>
        </form>

            </div>
@endsection
