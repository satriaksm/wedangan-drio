<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Tentukan rentang waktu berdasarkan pilihan
        $timeRange = $request->input('time_range', 'all_time');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        // Query untuk mendapatkan data dinamis
        $query = Order::query();

        // Filter berdasarkan rentang waktu
        if ($timeRange !== 'all_time') {
            switch ($timeRange) {
                case 'daily':
                    $query->whereDate('created_at', today());
                    break;
                case 'weekly':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                    break;
            }
        }

        // Tambahkan filter khusus untuk rentang tanggal kustom
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Statistik dashboard
        $totalCashiers = User::where('role', '2')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        // Total transaksi, total pendapatan, rata-rata pendapatan per transaksi
        $totalTransactions = $query->count();
        $totalRevenue = $query->sum('total_price');
        $averageRevenuePerTransaction = $totalTransactions > 0
            ? $totalRevenue / $totalTransactions
            : 0;

        // Top 10 produk terlaris
        $topProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereIn('orders.id', $query->pluck('id'))
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->selectRaw('SUM(order_items.quantity * products.selling_price) as total_revenue')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('pages.dashboard.index', [
            'totalCashiers' => $totalCashiers,
            'totalCategories' => $totalCategories,
            'totalProducts' => $totalProducts,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'averageRevenuePerTransaction' => $averageRevenuePerTransaction,
            'topProducts' => $topProducts,
            'selectedTimeRange' => $timeRange,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
