<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request (pastikan data sudah benar sebelum masuk ke DB)
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Hitung total jumlah item dan total harga keseluruhan
        $totalItems = 0;
        $totalPrice = 0;

        foreach ($request->products as $product) {
            $totalItems += $product['quantity'];
            $productModel = Product::findOrFail($product['product_id']);
            $totalPrice += $productModel->price * $product['quantity'];
        }

        // Simpan ke tabel `orders`
        $order = Order::create([
            'user_id' => auth()->id(), // Ambil user yang sedang login
            'total_items' => $totalItems,
            'total_price' => $totalPrice,
        ]);

        // Simpan ke tabel `order_items`
        foreach ($request->products as $product) {
            $productModel = Product::findOrFail($product['product_id']);
            $subtotalPrice = $productModel->price * $product['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'subtotal_price' => $subtotalPrice,
            ]);
        }

        return response()->json(['message' => 'Order berhasil disimpan.'], 201);
    }
}
