@extends('layouts.customer')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 bg-white shadow rounded">

    <h1 class="text-2xl font-bold text-[#5E2C1F] mb-4">Invoice #{{ $order->invoice_number }}</h1>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Info Umum --}}
    <div class="mb-6 text-sm">
        <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        <p><strong>Nama:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
        <p><strong>No HP:</strong> {{ $order->user->phone }}</p>
        <p><strong>Alamat:</strong> {{ $order->user->alamat ?? 'Belum diisi' }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? '-' }}</p>
        <p><strong>Status Pembayaran:</strong> 
            <span class="uppercase text-sm font-bold text-blue-700">{{ $order->status }}</span>
        </p>
    </div>

    {{-- Daftar Produk --}}
    <table class="w-full border border-gray-300 text-sm mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Produk</th>
                <th class="p-2 text-center">Jumlah</th>
                <th class="p-2 text-right">Harga</th>
                <th class="p-2 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order->items as $item)
                @php
                    $subtotal = $item->price * $item->quantity;
                    $total += $subtotal;
                @endphp
                <tr class="border-t">
                    <td class="p-2">{{ $item->product->name }}</td>
                    <td class="p-2 text-center">{{ $item->quantity }}</td>
                    <td class="p-2 text-right">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-2 text-right">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="bg-gray-100 font-bold">
                <td colspan="3" class="p-2 text-right">Total</td>
                <td class="p-2 text-right">Rp{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- Instruksi Transfer (jika bukan COD) --}}
    @if(strtolower($order->payment_method) != 'cod')
        <div class="bg-yellow-50 p-4 rounded border border-yellow-300 text-sm mb-6">
            <p class="font-semibold mb-1">Silakan transfer ke salah satu rekening berikut:</p>
            <ul class="list-disc list-inside text-gray-800">
                <li>BRI - 4739 0101 9019 538 (a.n. Faridah)</li>
                <li>DANA - 0819 9971 1628 (a.n. Rona Firdaus)</li>
            </ul>
            <p class="mt-2">Sertakan <strong>nomor invoice</strong> saat transfer dan unggah bukti di bawah ini.</p>
        </div>
    @endif

    {{-- Upload Bukti Transfer --}}
    @if(strtolower($order->payment_method) != 'cod')
        @if ($order->bukti_transfer)
            <div class="mb-4">
                <p class="text-sm text-gray-700">📎 Bukti pembayaran sudah diunggah:</p>
                <a href="{{ asset('storage/' . $order->bukti_transfer) }}" target="_blank" class="text-blue-600 underline text-sm">
                    Lihat Bukti Transfer
                </a>
            </div>
        @else
            <div class="mb-6">
                <form action="{{ route('payments.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block mb-2 font-semibold">Upload Bukti Pembayaran (gambar):</label>
                    <input type="file" name="proof" accept="image/*" required class="block mb-4 border border-gray-300 rounded p-2 w-full">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Upload Bukti</button>
                </form>
            </div>
        @endif
    @endif

    <div class="text-right mt-6">
        <a href="{{ route('orders.index') }}" class="inline-block bg-[#5E2C1F] text-white px-4 py-2 rounded hover:bg-[#4b221a]">Kembali ke Pesanan</a>
    </div>

</div>
@endsection
