<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Exports\RiwayatTransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        // Default tanggal jika tidak ada input
        $startDate = $request->input('start_date', now()->format('m/d/Y'));
        $endDate = $request->input('end_date', now()->format('m/d/Y'));

        // Ambil input filter
        $id = $request->input('id');
        $user = Auth::user();

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
            // Mengambil order dengan relasi items dan product
            $order = Order::with('items.product', 'user')->findOrFail($id);

            return response()->json([
                'id' => $order->id,
                'cashier' => $order->user->name,
                'date' => $order->created_at->format('d-m-Y H:i'),
                'payment' => $order->payment_method, // Ambil langsung kolom payment_method
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
