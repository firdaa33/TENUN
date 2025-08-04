@extends('layouts.customer')

@section('content')
<div class="max-w-xl px-4 py-10 mx-auto">
    <h2 class="mb-4 text-2xl font-bold">Beri Rating untuk {{ $product->name }}</h2>

    <form action="{{ route('produk.rating.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label for="rating" class="block font-medium">Rating (1-5)</label>
        <select name="rating" id="rating" class="w-full p-2 border rounded" required>
            <option value="">Pilih rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} Bintang</option>
            @endfor
        </select>

        <label for="comment" class="block font-medium">Komentar (opsional)</label>
        <textarea name="comment" id="comment" class="w-full p-2 border rounded" rows="4"></textarea>

        <button type="submit" class="px-4 py-2 text-white bg-black rounded hover:bg-gray-800">
            Kirim Rating
        </button>
    </form>
</div>
@endsection
