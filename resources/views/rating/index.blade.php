@extends('layouts.customer')

@section('content')
<div class="max-w-4xl p-4 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">Ulasan Pelanggan</h2>

    @forelse($ratings as $rating)
        <div class="p-4 mb-4 bg-white border rounded shadow">
            <div class="flex items-center justify-between mb-2">
                <span class="font-semibold">{{ $rating->user->name }}</span>
                <span class="text-sm text-gray-500">{{ $rating->created_at->format('d M Y') }}</span>
            </div>
            <div class="mb-2 text-yellow-400">
                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= $rating->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </div>
            <p class="italic text-gray-700">"{{ $rating->comment }}"</p>
            <div class="mt-2 text-sm text-gray-600">Untuk produk: <strong>{{ $rating->product->name }}</strong></div>
        </div>
    @empty
        <p>Belum ada ulasan yang tersedia.</p>
    @endforelse
</div>
@endsection
