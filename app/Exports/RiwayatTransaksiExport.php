<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;

class RiwayatTransaksiExport implements FromView
{
    protected $filter;
    protected $date;
    protected $dateText;

    public function __construct($filter, $date)
    {
        $this->filter = $filter;
        $this->date = $date;
        $this->dateText = $this->generateDateText();
    }

    protected function generateDateText()
    {
        $carbonDate = Carbon::parse($this->date);

        switch ($this->filter) {
            case 'daily':
                return $carbonDate->format('d F Y');
            case 'weekly':
                $startOfWeek = $carbonDate->startOfWeek();
                $endOfWeek = $carbonDate->endOfWeek();
                return $startOfWeek->format('d F Y') . ' - ' . $endOfWeek->format('d F Y');
            case 'monthly':
                return $carbonDate->format('F Y');
            default:
                return '';
        }
    }

    public function view(): View
    {
        // Inisialisasi query builder
        $query = Order::query();

        // Filter berdasarkan pilihan
        switch ($this->filter) {
            case 'daily':
                $query->whereDate('created_at', $this->date);
                break;
            case 'weekly':
                $startOfWeek = Carbon::parse($this->date)->startOfWeek();
                $endOfWeek = Carbon::parse($this->date)->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                break;
            case 'monthly':
                $query->whereMonth('created_at', Carbon::parse($this->date)->month)
                    ->whereYear('created_at', Carbon::parse($this->date)->year);
                break;
        }

        // Ambil orders sesuai filter
        $orders = $query->get();
        $dateText = $this->dateText;

        return view('pages.history.table', compact('orders', 'dateText'));
    }
}
