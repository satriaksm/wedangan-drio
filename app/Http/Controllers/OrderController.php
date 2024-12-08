<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatTransaksiExport;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $selectedUsers = $request->input('users', []);
        $id = $request->input('id');

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        // Ambil rentang tanggal dan nomor faktur dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $id = $request->input('id');


        $orders = Order::when($id, function ($query, $id) {
            return $query->where('id', 'like',   $id );
        })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                Log::info("Start Date: $startDate, End Date: $endDate");
                return $query->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->when(!empty($selectedUsers), function ($query) use ($selectedUsers) {
                return $query->whereIn('user_id', $selectedUsers);
            })
            ->with('orderItems') // Eager load order_items
            ->get();

            $users = User::all();
        return view('pages.history.index', compact('orders', 'users'));
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
                'payment' => $order->payment_method,
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
        } else if ($request->action === 'excel') {
            // Proses download Excel
            return Excel::download(
                new RiwayatTransaksiExport($request->filter, $request->date),
                $filename . '.xlsx'
            );
        }
    }
}
