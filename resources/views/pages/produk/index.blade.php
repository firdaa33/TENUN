@extends('layouts.customer')

@php
    $cartCount = session('cart') ? collect(session('cart'))->sum('quantity') : 0;
@endphp

@section('content')
<div class="bg-white max-w-6xl mx-auto px-4 py-8 relative">
    <!-- Judul -->
    <h1 class="text-1xl sm:text-2xl font-bold text-[#5E2C1F] mb-2 text-center">
        Koleksi Produk Tenun
    </h1>
    <div class="w-25 h-1 bg-[#5E2C1F] mx-auto mb-6 rounded"></div>

    {{-- FORM SEARCH --}}
   <form action="{{ route('produk.index') }}" method="GET" class="flex items-center gap-2">
    <input 
        type="text" 
        name="q" 
        value="{{ request('q') }}" 
        placeholder="Cari produk..." 
        class="border border-gray-300 px-4 py-2 rounded w-full max-w-md"
    >
    <button 
        type="submit" 
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Cari
    </button>
    </form>

    @if($products->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <a href="{{ route('produk.show', $product->slug) }}" class="flex justify-center">
                        <img src="{{ url($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-[200px] h-[200px] object-cover rounded-md shadow">
                    </a>
                    <div class="p-3 flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-[#5E2C1F] truncate">{{ $product->name }}</h2>
                            <p class="text-xs text-gray-600 mb-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            {{-- Tambah ke Keranjang --}}
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="text-xl" title="Tambah ke Keranjang">🛒</button>
                            </form>

                            {{-- Tombol Beli --}}
                            <form method="GET" action="{{ route('checkout') }}">
                                <button class="bg-[#5E2C1F] text-white text-xs px-3 py-1 rounded hover:bg-[#4b221a]">
                                    Beli
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-gray-500">Tidak ada produk yang tersedia.</p>
    @endif
</div>
@endsection
