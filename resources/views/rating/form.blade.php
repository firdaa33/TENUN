@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold mb-4">Beri Rating untuk {{ $product->name }}</h2>

    <form action="{{ route('produk.rating.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label for="rating" class="block font-medium">Rating (1-5)</label>
        <select name="rating" id="rating" class="w-full border rounded p-2" required>
            <option value="">Pilih rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} Bintang</option>
            @endfor
        </select>

        <label for="comment" class="block font-medium">Komentar (opsional)</label>
        <textarea name="comment" id="comment" class="w-full border rounded p-2" rows="4"></textarea>

        <button type="submit" class="bg-black text-white py-2 px-4 rounded hover:bg-gray-800">
            Kirim Rating
        </button>
    </form>
</div>
@endsection
