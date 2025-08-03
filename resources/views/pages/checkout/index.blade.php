@extends('layouts.customer')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-6 text-[#5E2C1F] text-center">Checkout</h2>

    {{-- ALAMAT --}}
    <div class="bg-gray-100 p-4 rounded mb-6">
        <h3 class="font-semibold text-lg text-[#5E2C1F]">Alamat Pengiriman</h3>

        @if (auth()->user()->alamat)
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Telepon:</strong> {{ auth()->user()->phone ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ auth()->user()->alamat }}</p>
        @else
            <p class="text-red-500 font-semibold">Alamat belum diisi.</p>
        @endif

        <a href="{{ route('checkout.ubah-alamat') }}" class="text-blue-500 hover:underline text-sm inline-block mt-2">
            ✏️ Ubah
        </a>

    </div>

    {{-- PRODUK YANG DIBELI --}}
    <div class="mb-6">
        <h3 class="font-semibold text-lg mb-2 text-[#5E2C1F]">Produk yang Dibeli</h3>
        <div class="divide-y rounded border">
            @php $total = 0; @endphp
            @forelse ($cart as $item)
                @php
                    $quantity = $item['quantity'] ?? 1;
                    $subtotal = $item['price'] * $quantity;
                    $total += $subtotal;
                @endphp
                <div class="p-4 flex items-center gap-4">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded">
                    <div class="flex-1">
                        <div class="font-semibold">{{ $item['name'] }}</div>
                        <div class="text-sm text-gray-600">{{ $quantity }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                    </div>
                    <div class="font-semibold text-right">
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">
                    Tidak ada produk yang dipilih untuk checkout.
                </div>
            @endforelse
        </div>
    </div>

    {{-- FORM CHECKOUT --}}
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        {{-- Total --}}
        <div class="text-right mb-4">
            <p class="text-xl font-bold text-[#5E2C1F]">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-6">
            <label for="payment_method" class="block font-semibold mb-2">Pilih Metode Pembayaran:</label>
            <select name="payment_method" id="payment_method" class="border rounded w-full p-2" required>
                <option value="">-- Pilih Metode --</option>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>
                <option value="Mandiri">Mandiri</option>
                <option value="DANA">DANA</option>
                <option value="OVO">OVO</option>
                <option value="GOPAY">GOPAY</option>
                <option value="LinkAja">LinkAja</option>
                <option value="ShopeePay">ShopeePay</option>
                <option value="cod">COD (Bayar di Tempat)</option>
            </select>
        </div>

        {{-- Info Pembayaran Transfer --}}
        <div class="mb-6 text-sm text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded">
            Jika memilih pembayaran selain COD, kamu akan diarahkan ke halaman invoice untuk mengupload bukti transfer.
        </div>

        {{-- Tombol Submit --}}
        <button type="submit"
            class="bg-[#5E2C1F] text-white px-6 py-2 rounded hover:bg-[#4b221a] w-full sm:w-auto disabled:opacity-50"
            @if ($total == 0) disabled @endif>
            Buat Pesanan
        </button>

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Flash Success --}}
        @if (session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>
@endsection
