<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);
        // Ambil rentang tanggal dan nomor faktur dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $id = $request->input('id');

        // Query untuk mengambil data berdasarkan filter
        $orders = Order::when($id, function ($query, $id) {
            return $query->where('id', 'like', '%' . $id . '%');
        })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                Log::info("Start Date: $startDate, End Date: $endDate");
                return $query->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->with('orderItems') // Eager load order_items
            ->get();

        return view('pages.history.index', compact('orders'));
    }

    public function show($id)
    {
        try {
            $order = Order::with('items.product', 'user')->findOrFail($id);
            return response()->json([
                'id' => $order->id,
                'cashier' => $order->user->name,
                'date' => $order->created_at->format('d-m-Y H:i'),
                'total' => $order->total_price,
                'items' => $order->items->map(function ($item) {
                    return [
                        'quantity' => $item->quantity,
                        'name' => $item->product->name,
                        'subtotal' => $item->subtotal_price,
                    ];
                }),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => 'Detail order tidak ditemukan',
                'debug' => $e->getMessage()
            ], 500);
        }
    }
}
