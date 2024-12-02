<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('pages.transaction.index', compact('products', 'categories'));
    }

    public function pay(Request $request): View
    {
        try {
            $items = json_decode($request->items, true);
            $items = collect($items)->map(function ($item) {
                $product = Product::findOrFail($item['id']);
                return [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->selling_price * $item['quantity']
                ];
            });

            return view('pages.transaction.pay', [
                'items' => $items,
                'total' => $request->total,
                'paymentMethod' => $request->payment_method,
                'cashAmount' => $request->cash_amount ?? 0
            ]);
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            return redirect()->route('transaction.index')
                ->with('error', 'Terjadi kesalahan dalam memproses pembayaran');
        }
    }

    public function process(Request $request)
    {
        Log::info('Request received:', $request->all());

        try {
            $validated = $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.price' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'payment_method' => 'required|string|in:cash,qris',
                'payment_amount' => 'required|numeric|min:0'
            ]);

            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_items' => collect($request->items)->sum('quantity'),
                'total_price' => $request->total,
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'change_amount' => $request->payment_amount - $request->total
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'subtotal_price' => $item['price'] * $item['quantity']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order' => $order,
                'message' => 'Transaksi berhasil'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Transaksi gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}
