@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6 text-[#5E2C1F]">Invoice Pembayaran</h1>

    {{-- Info Order --}}
    <div class="bg-white border rounded p-4 shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Pesanan</h2>
        <p><strong>Nomor Pesanan:</strong> #{{ $order->id }}</p>
        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
    </div>

    {{-- Daftar Produk --}}
    <div class="bg-white border rounded p-4 shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Detail Produk</h2>
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Produk</th>
                    <th class="p-2 text-center">Harga</th>
                    <th class="p-2 text-center">Jumlah</th>
                    <th class="p-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($order->items as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr class="border-t">
                        <td class="p-2">{{ $item->product->name }}</td>
                        <td class="p-2 text-center">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td class="p-2 text-center">{{ $item->quantity }}</td>
                        <td class="p-2 text-right">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="border-t font-semibold bg-gray-50">
                    <td colspan="3" class="p-2 text-right">Total:</td>
                    <td class="p-2 text-right">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Instruksi Pembayaran --}}
    <div class="bg-white border rounded p-4 shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Instruksi Pembayaran</h2>
        <p>Silakan transfer ke rekening berikut:</p>
        <ul class="list-disc ml-6 mt-2 text-sm">
            <li><strong>Bank/Metode:</strong> {{ $order->payment_method }}</li>
            <li><strong>Nomor:</strong> 1234567890</li>
            <li><strong>Atas Nama:</strong> Rona Firda</li>
        </ul>
        <p class="mt-2 text-sm text-gray-600">Setelah transfer, upload bukti pembayaran untuk kami proses.</p>
    </div>

    {{-- Upload Bukti Pembayaran --}}
    <div class="bg-white border rounded p-4 shadow">
        <h2 class="text-lg font-semibold mb-2">Upload Bukti Transfer</h2>
        <form action="{{ route('orders.confirm', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="bukti_transfer" required class="mb-4">
            <button type="submit" class="bg-[#5E2C1F] text-white px-6 py-2 rounded hover:bg-[#4b221a]">Upload</button>
        </form>
    </div>
    @if (session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

</div>
@endsection
