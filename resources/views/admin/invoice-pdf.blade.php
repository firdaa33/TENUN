<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
        }
        .logo {
            height: 60px;
            margin-bottom: 10px;
        }
        .info, .items {
            width: 100%;
            margin-top: 20px;
        }
        .info td {
            padding: 4px;
        }
        .items th, .items td {
            padding: 6px;
            border: 1px solid #ccc;
        }
        .items th {
            background-color: #f0f0f0;
        }
        .qr {
            width: 150px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>SELAWEAVE</h2>
        <p>Jl. Tenun No.1, Indonesia</p>
    </div>

    <table class="info">
        <tr>
            <td><strong>Invoice:</strong> {{ $order->invoice_number }}</td>
            <td><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td><strong>Pelanggan:</strong> {{ $order->user->name }}</td>
            <td><strong>Status:</strong> {{ ucfirst($order->status) }}</td>
        </tr>
        <tr>
            <td><strong>Metode Bayar:</strong> {{ strtoupper($order->payment_method) }}</td>
        </tr>
    </table>

    <h4>Detail Pesanan:</h4>
    <table class="items" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp{{ number_format($item->price) }}</td>
                <td>Rp{{ number_format($item->price * $item->quantity) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><strong>Rp{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity)) }}</strong></td>
            </tr>
        </tbody>
    </table>

    @if ($order->payment_method === 'transfer')
        <div style="margin-top: 30px;">
            <p><strong>Pembayaran via Transfer</strong></p>
            <img src="{{ public_path('images/qris.jpeg') }}" class="qr" alt="QR Code Pembayaran">
        </div>
    @endif

</body>
</html>
