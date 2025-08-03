@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::guard('admin')->user()->name }} 🎉</p>

    <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="text-red-600 hover:underline">Logout Admin</button>
    </form>
</div>
@endsection
