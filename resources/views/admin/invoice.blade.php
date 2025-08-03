<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            height: 100%;
            max-width: 960px;
            margin: auto;
            padding: 30px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }

        td, th {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background: #f2f2f2;
        }

        .totals {
            margin-top: 15px;
            text-align: right;
            font-size: 14px;
        }

        .footer {
            margin-top: 40px;
            font-size: 11px;
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice</h1>

        <table>
            <tr>
                <td><strong>No. Invoice:</strong> {{ $order->invoice_number }}</td>
                <td><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <td><strong>Nama:</strong> {{ $order->user->name }}</td>
                <td><strong>Metode:</strong> {{ strtoupper($order->payment_method) }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <strong>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
        </div>

        <div class="footer">
            Terima kasih telah berbelanja di Selaweave.
        </div>
    </div>
</body>
</html>
