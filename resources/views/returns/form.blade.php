@extends('layouts.customer')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4 text-[#5E2C1F]">Ajukan Pengembalian</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('returns.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        {{-- Textarea Alasan --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="reason">Alasan Pengembalian</label>
            <textarea name="reason" id="reason" rows="4" required class="w-full border rounded p-2" placeholder="Tuliskan alasan pengembalian di sini..."></textarea>
        </div>

        {{-- Upload Foto --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="image">Upload Bukti Foto (opsional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full border rounded p-2">
        </div>

        {{-- Tombol --}}
        <button type="submit" class="bg-[#5E2C1F] text-white px-4 py-2 rounded">Kirim Permintaan</button>
        <a href="{{ route('orders.index') }}" class="ml-4 text-gray-600 hover:underline">← Kembali</a>
    </form>
</div>
@endsection
