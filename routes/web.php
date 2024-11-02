<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Redirect to dashboard if authenticated
    }
    return redirect()->route('login'); // Redirect to login if not authenticated
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/transaction', function () {
    return view('pages.transaction');
})->middleware(['auth', 'verified'])->name('transaction');
Route::get('/history', function () {
    return view('pages.history');
})->middleware(['auth', 'verified'])->name('history');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images/{folder}/{filename}', function ($folder, $filename) {
    $path = resource_path('images/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404); // Mengembalikan 404 jika gambar tidak ditemukan
    }

    return Response::file($path); // Mengembalikan file gambar
});

require __DIR__.'/auth.php';
