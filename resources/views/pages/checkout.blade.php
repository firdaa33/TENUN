@extends('layouts.customer')

@section('content')
<div class="max-w-lg mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Checkout</h2>

    @auth
    <form method="POST" action="{{ route('checkout.process') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Nama --}}
        <div>
            <label for="name" class="block font-semibold">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                class="w-full border p-2 rounded" required>
        </div>

        {{-- Nomor HP --}}
        <div>
            <label for="phone" class="block font-semibold">Nomor HP</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                class="w-full border p-2 rounded" required>
        </div>

        {{-- Alamat Berjenjang --}}
        <div>
            <label class="block font-semibold">Alamat</label>
            <select id="province" name="province" class="w-full border p-2 rounded mb-2" required></select>
            <select id="city" name="city" class="w-full border p-2 rounded mb-2" required></select>
            <select id="district" name="district" class="w-full border p-2 rounded mb-2" required></select>
            <select id="village" name="village" class="w-full border p-2 rounded mb-2" required></select>
            <textarea id="address" name="address" rows="3" class="w-full border p-2 rounded"
                placeholder="Detail alamat seperti dusun/RT/RW/jalan" required>{{ old('address', auth()->user()->address) }}</textarea>
        </div>
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Alamat Pengiriman</h2>

            @if (auth()->user()->alamat)
                <p class="bg-gray-100 p-3 rounded mb-2">
                    {{ auth()->user()->alamat }}
                </p>
            @else
                <p class="text-red-500 mb-2">Alamat belum diisi.</p>
            @endif

            <a href="{{ route('alamat.edit') }}" class="text-sm text-blue-600 hover:underline">
                ✏️ Ubah Alamat
            </a>
        </div>

        {{-- Metode Pembayaran --}}
        <div>
            <label for="payment_method" class="block font-semibold">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="w-full border p-2 rounded" required>
                <option value="cod">COD</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
                <option value="mbanking">M-Banking</option>
            </select>
        </div>

        {{-- Upload Bukti Transfer --}}
        <div>
            <label for="bukti_transfer" class="block font-semibold">Upload Bukti Transfer</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer"
                class="w-full border p-2 rounded bg-white">
        </div>

        <button class="w-full bg-[#5E2C1F] text-white py-2 rounded">
            Buat Pesanan
        </button>
    </form>
    @else
        <p>
            Silakan <a class="text-blue-600 underline" href="{{ route('register',['redirect'=>'checkout']) }}">register</a>
            atau <a class="text-blue-600 underline" href="{{ route('login',['redirect'=>'checkout']) }}">login</a> terlebih dahulu.
        </p>
    @endauth
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/alamat.js') }}"></script>
@endpush
