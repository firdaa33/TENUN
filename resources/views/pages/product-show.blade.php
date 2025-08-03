@extends('layouts.customer')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row gap-6">
        <img src="{{ asset('storage/'.$product->image) }}" class="w-full sm:w-1/2 h-64 object-cover rounded">
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-[#5E2C1F] mb-2">{{ $product->name }}</h2>

            <p class="text-xl font-semibold mb-2">
                Rp {{ number_format($product->price,0,',','.') }}
            </p>

            <p class="text-gray-600 mb-4">
                {{ $product->description }}
            </p>

            <p class="mb-4">
                <span class="font-semibold">Stok:</span> {{ $product->stock }}
            </p>

            <form method="POST" action="{{ route('cart.add') }}" class="inline">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button class="bg-[#5E2C1F] text-white px-6 py-2 rounded">
                    Tambah ke Keranjang
                </button>
            </form>
            @if (session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
