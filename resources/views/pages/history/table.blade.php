
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-footer {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Riwayat Transaksi {{ $dateText }}</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Barang</th>
                <th>Pembayaran</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ implode(', ', $order->orderItems->pluck('product.name')->toArray()) }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
              <td colspan="3"><h4>Total Transaksi : {{ $orders->count() }}</h4></td>
              <td colspan="2"><h4>Total Jumlah : Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</h4></td>
            </tr>
          </tfoot>
    </table>
</body>
</html>
