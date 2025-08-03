@extends('layouts.customer')

@section('content')
<div class="bg-[#F7F4F2] min-h-screen py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6">Keranjang</h1>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        {{-- Komponen Livewire Cart --}}
        @livewire('cart-table')
    </div>
</div>
@endsection
