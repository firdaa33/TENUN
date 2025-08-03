@extends('layouts.customer')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-[#5E2C1F] mb-4">Detail Pesanan</h2>

    {{-- Info Pesanan --}}
    <div class="bg-gray-100 p-4 rounded mb-6">
        <p><strong>Nomor Invoice:</strong> {{ $order->invoice_number }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
    </div>

    {{-- Daftar Produk --}}
    <div class="mb-6 border rounded">
        @foreach($order->items as $item)
        <div class="flex items-center gap-4 border-b p-4">
            <img src="{{ asset($item->product->image) }}" class="w-20 h-20 object-cover rounded" alt="">
            <div class="flex-1">
                <div class="font-semibold">{{ $item->product->name }}</div>
                <div class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
            </div>
            <div class="font-semibold">
                Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
            </div>
        </div>
        @endforeach
    </div>

    {{-- Total --}}
    <div class="text-right text-xl font-bold text-[#5E2C1F] mb-6">
        Total: Rp {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}
    </div>

    {{-- Nomor Rekening --}}
    @if ($order->payment_method !== 'cod')
    <div class="bg-yellow-50 border border-yellow-300 p-4 rounded mb-6">
        <p class="font-semibold mb-2">Silakan transfer ke rekening berikut:</p>

        @php
            $rekening = match(strtolower($order->payment_method)) {
                'bca' => 'BCA - 1234567890 a.n Selaweave',
                'bri' => 'BRI - 0987654321 a.n Selaweave',
                'mandiri' => 'Mandiri - 5678901234 a.n Selaweave',
                'dana' => 'DANA - 0812xxxxxxx a.n Selaweave',
                'ovo' => 'OVO - 0812xxxxxxx a.n Selaweave',
                'gopay' => 'GOPAY - 0812xxxxxxx a.n Selaweave',
                'linkaja' => 'LinkAja - 0812xxxxxxx a.n Selaweave',
                'shopeepay' => 'ShopeePay - 0812xxxxxxx a.n Selaweave',
                default => '-',
            };
        @endphp

        <p class="text-lg text-red-600 font-bold">{{ $rekening }}</p>
        <p class="text-sm text-gray-600 mt-2">Setelah transfer, upload bukti di bawah ini.</p>
    </div>
    @endif

    {{-- Upload Bukti Transfer --}}
    @if ($order->payment_method !== 'cod')
        @if ($order->bukti_transfer)
            <div class="mb-6">
                <p class="font-semibold mb-2">Bukti Transfer:</p>
                <img src="{{ asset('storage/' . $order->bukti_transfer) }}" alt="Bukti Transfer" class="w-64 rounded border">
            </div>
        @elseif ($order->status === 'pending')
            <form action="{{ route('orders.uploadBukti', $order) }}" method="POST" enctype="multipart/form-data" class="mb-6">
                @csrf
                <label class="block mb-2 font-semibold">Upload Bukti Transfer:</label>
                <input type="file" name="bukti_transfer" required class="border p-2 rounded mb-3 w-full">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Bukti</button>
            </form>
        @endif
    @endif

    <a href="{{ route('orders.index')') }}" class="text-blue-500 hover:underline text-sm">← Kembali ke Pesanan</a>
</div>
@endsection
