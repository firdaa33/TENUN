<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SELAWEAVE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-[#5E2C1F]">Selaweave</a>
        <div class="flex gap-4">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('produk.index') }}">Produk</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('rating.index') }}" class="hover:text-blue-500">Rating</a>  
        </div>
        <div class="flex gap-3 items-center">
            @auth
                <a href="{{ route('orders.index') }}">Pesanan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Isi Halaman -->
    <main class="min-h-[80vh]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 bg-gray-100 border-t mt-8">
        <p>&copy; {{ date('Y') }} SELAWEAVE. All rights reserved.</p>
    </footer>

    @livewireScripts
</body>
</html>
