@extends('layouts.customer')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <!-- Form Pencarian -->
        <form method="GET" class="flex-1 max-w-sm">
            <input name="q" placeholder="Cari produk..." value="{{ request('q') }}" class="w-full border px-3 py-2 rounded">
        </form>

        <!-- Ikon Keranjang, Chat, dan Pesanan -->
        <div class="flex items-center gap-4 ml-4">
            <livewire:cart-icon />

            <!-- Ikon Pesanan Saya -->
            @auth
                <a href="{{ route('orders.index') }}" title="Pesanan Saya" class="hover:scale-110 text-[#5E2C1F]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>

    <!-- Daftar Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($products as $p)
        <div class="border rounded shadow p-2 hover:shadow-md transition">
            <a href="{{ route('produk.show', $p) }}">
                <img src="{{ asset('storage/produk'.$p->image) }}" class="w-full h-32 object-cover rounded mb-2">
                <h3 class="font-semibold text-[#5E2C1F] hover:underline">{{ $p->name }}</h3>
            </a>
            <p class="text-sm text-gray-600 mb-1">Rp {{ number_format($p->price,0,',','.') }}</p>

            <!-- Tombol Aksi -->
            <div class="flex justify-between mt-2 items-center gap-2">
                <!-- Tambah ke Keranjang -->
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $p->id }}">
                    <button title="Tambah ke Keranjang" class="text-[#5E2C1F] hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                        </svg>
                    </button>
                </form>

                <!-- Beli Langsung -->
                <form method="POST" action="{{ route('cart.add') }}" onsubmit="event.preventDefault(); this.submit(); window.location='{{ auth()->check() ? route('checkout') : route('register', ['redirect' => 'checkout']) }}';">
                    @csrf
                    <input type="hidden" name="id" value="{{ $p->id }}">
                    <button class="bg-[#5E2C1F] text-white px-3 py-1 rounded text-sm">Beli</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">{{ $products->withQueryString()->links() }}</div>
</div>
@endsection
