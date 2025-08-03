@extends('layouts.customer')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold mb-4 text-[#5E2C1F]">Ubah Alamat</h2>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <label class="block font-medium mb-2">Alamat Lengkap</label>
        <textarea name="alamat" rows="4" class="w-full border px-3 py-2 rounded">{{ old('alamat', $user->alamat) }}</textarea>

        @error('alamat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 bg-[#5E2C1F] text-white px-6 py-2 rounded hover:bg-[#4b221a]">
            Simpan Alamat
        </button>
    </form>
</div>
@endsection
