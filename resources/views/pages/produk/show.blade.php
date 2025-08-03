@extends('layouts.customer')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row gap-6">

        {{-- Gambar Produk --}}
        <div class="sm:w-1/2">
            <img src="{{ url($product->image) }}" alt="{{ $product->name }}" class="w-[180px] h-auto object-cover rounded-md shadow">
            <a href="{{ route('produk.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">← Kembali ke Daftar Produk</a>
        </div>

        {{-- Detail Produk --}}
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-[#5E2C1F] mb-2">{{ $product->name }}</h2>

            @php
                $price = str_pad($product->price, 6, '0', STR_PAD_LEFT);
                $price = number_format($price, 0, ',', '.');
            @endphp

            <p class="text-xl font-semibold mb-2">
                Rp {{ $price }}
            </p>

            <p class="text-gray-600 mb-4">
                {{ $product->description }}
            </p>

            <p class="mb-4">
                <span class="font-semibold">Stok:</span> {{ $product->stock }}
            </p>

            {{-- Tambah ke Keranjang --}}
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" class="border p-2 rounded w-20">
                <button type="submit" class="bg-[#5E2C1F] text-white px-4 py-2 rounded">Tambah ke Keranjang</button>
            </form>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded mt-4">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
