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
        Log::info('Payment request received', $request->all());  // Add this line
        // Validate the incoming request
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0'
        ]);

        $items = collect($request->items)->map(function ($item) {
            $product = Product::find($item['id']);
            return [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $product->selling_price * $item['quantity']
            ];
        });

        $total = $items->sum('subtotal');
        $paymentMethod = $request->payment_method;

        return view('pages.transaction.pay', compact('items', 'total', 'paymentMethod'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'payment_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,qris'
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'total_items' => $request->total,
                'total_price' => $request->payment_amount,
            ]);

            // Create order items
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'subtotal_price' => $product->selling_price * $item['quantity']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order' => $order,
                'message' => 'Transaction processed successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Transaction failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
