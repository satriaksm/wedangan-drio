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
        $query = Order::query();

        // Filter berdasarkan nomor faktur (ID)
        if ($id) {
            $query->where('id', 'like', '%' . $id . '%');
        }

        // Filter berdasarkan rentang tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Filter untuk user non-admin (role 2)
        if ($user->role === 2) {
            $query->where('user_id', $user->id);
        }

        // Eager load order items dan produk terkait
        $orders = $query->with('orderItems.product')
            ->latest()
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

    public function export_transactions(Request $request)
    {
        // Validasi input
        $request->validate([
            'filter' => 'required|in:daily,weekly,monthly',
            'date' => 'required|date'
        ]);

        // Tentukan nama file berdasarkan filter
        $filename = 'laporan_transaksi_' . $request->filter . '_' .
                    Carbon::parse($request->date)->format('Y-m-d');

        // Cek aksi yang dipilih
        if ($request->action === 'pdf') {
            // Proses download PDF
            $query = Order::query();

            switch ($request->filter) {
                case 'daily':
                    $query->whereDate('created_at', $request->date);
                    $dateText = Carbon::parse($request->date)->format('d F Y');
                    break;
                case 'weekly':
                    $startOfWeek = Carbon::parse($request->date)->startOfWeek();
                    $endOfWeek = Carbon::parse($request->date)->endOfWeek();
                    $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                    $dateText = $startOfWeek->format('d F Y') . ' - ' . $endOfWeek->format('d F Y');
                    break;
                case 'monthly':
                    $query->whereMonth('created_at', Carbon::parse($request->date)->month)
                        ->whereYear('created_at', Carbon::parse($request->date)->year);
                    $dateText = Carbon::parse($request->date)->format('F Y');
                    break;
            }

            $orders = $query->get();

            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('pages.history.table', compact('orders', 'dateText'))->render());
            $mpdf->Output($filename . '.pdf', 'D');
        }
        else if ($request->action === 'excel') {
            // Proses download Excel
            return Excel::download(
                new RiwayatTransaksiExport($request->filter, $request->date),
                $filename . '.xlsx'
            );
        }
    }



}
