@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Beri Rating untuk Produk: {{ $product->name }}</h2>

    <form action="{{ route('produk.rate', $product->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label for="comment">Komentar (opsional)</label>
            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
