<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::select('id', 'user_id', 'payment_method', 'total_items', 'total_price', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'User ID','Payment', 'Total Items', 'Total Price', 'Created At'];
    }
}

