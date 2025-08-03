@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">Ulasan Pelanggan</h2>

    @forelse($ratings as $rating)
        <div class="mb-4 border p-4 rounded bg-white shadow">
            <div class="flex justify-between items-center mb-2">
                <span class="font-semibold">{{ $rating->user->name }}</span>
                <span class="text-sm text-gray-500">{{ $rating->created_at->format('d M Y') }}</span>
            </div>
            <div class="text-yellow-400 mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= $rating->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </div>
            <p class="text-gray-700 italic">"{{ $rating->comment }}"</p>
            <div class="text-sm text-gray-600 mt-2">Untuk produk: <strong>{{ $rating->product->name }}</strong></div>
        </div>
    @empty
        <p>Belum ada ulasan yang tersedia.</p>
    @endforelse
</div>
@endsection
