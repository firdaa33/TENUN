@extends('layouts.customer')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-xl font-bold mb-4">Ajukan Pengembalian</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('returns.store', ['order' => $order->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Pengembalian</label>
            <textarea name="reason" rows="4" class="w-full border p-2 rounded" required>{{ old('reason') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Bukti Foto (opsional)</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>
@endsection
