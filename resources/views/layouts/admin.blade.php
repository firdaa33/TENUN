<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-6xl mx-auto py-6 px-4">
        {{-- Tambahkan header atau navbar kalau perlu --}}
        <h1 class="text-3xl font-bold text-center mb-8">Halaman Admin</h1>

        {{-- Konten halaman --}}
        @yield('content')
    </div>
</body>
</html>
