@extends('layouts.customer')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-4 text-[#5E2C1F]">Invoice Pembayaran</h2>

    <div class="bg-white p-4 shadow rounded border">
        <p><strong>No. Pesanan:</strong> {{ $order->id }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
        <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat }}</p>
    </div>

    <div class="mt-6 bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm">
        Silakan transfer ke rekening berikut:
        <ul class="mt-2 list-disc pl-6">
            <li>DANA - 0819 9971 1628 a.n. RONA FIRDAUS</li>
            <li>BRI - 4739 0101 9019 538 a.n. FARIDAH</li>
            <!-- Tambahkan sesuai kebutuhan -->
        </ul>
        <p class="mt-2 text-red-600">Setelah transfer, upload bukti pembayaran di bawah.</p>
    </div>

    {{-- FORM UPLOAD BUKTI --}}
    <form action="{{ route('orders.uploadBukti', $order->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
        @csrf
        <label for="bukti_transfer" class="block font-semibold mb-2">Upload Bukti Transfer:</label>
        <input type="file" name="bukti_transfer" accept="image/*" required class="border rounded w-full p-2 mb-4">
        <button type="submit" class="bg-[#5E2C1F] text-white px-4 py-2 rounded hover:bg-[#4b221a]">
            Upload
        </button>
    </form>

    @if ($order->bukti_transfer)
        <div class="mt-6">
            <h4 class="font-semibold mb-2">Bukti Transfer:</h4>
            <img src="{{ asset($order->bukti_transfer) }}" alt="Bukti Transfer" class="max-w-full rounded border">
        </div>
    @endif

</div>
@endsection
