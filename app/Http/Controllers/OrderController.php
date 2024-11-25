<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

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

        $user = Auth::user();

        // Query untuk mengambil data berdasarkan filter, hanya transaksi yang ditangani oleh cashier
        $orders = Order::when($id, function ($query, $id) {
                return $query->where('id', 'like', '%' . $id . '%');
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->when($user->role_id === 2, function ($query) use ($user) { // Pastikan hanya cashier yang melihat transaksinya
                return $query->where('user_id', $user->id);
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

        $user = Auth::user();
        // Simpan ke tabel `orders`
        $order = Order::create([
            'user_id' => $user->id, // Ambil user yang sedang login
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


    public function exportExcel()
    {
        return Excel::download(new SalesReportExport, 'sales_report.xlsx');
    }

}
