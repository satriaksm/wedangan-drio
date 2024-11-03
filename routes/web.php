<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
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

    // Route::get('/products', [ProductsController::class, 'index'])->name('produk.index');
    // Route::get('/products/create', [ProductsController::class, 'create'])->name('produk.create');
    // Route::post('/products', [ProductsController::class, 'store'])->name('produk.store');
    // Route::get('/products/update/{id}', [ProductsController::class, 'edit'])->name('produk.edit');
    // Route::put('/products/{id}', [ProductsController::class, 'update'])->name('produk.update');
    // Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('produk.destroy');
});

Route::get('/images/{folder}/{filename}', function ($folder, $filename) {
    $path = resource_path('images/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404); // Mengembalikan 404 jika gambar tidak ditemukan
    }

    return Response::file($path); // Mengembalikan file gambar
});

require __DIR__.'/auth.php';
