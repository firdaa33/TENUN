<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUNué</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-[#fffdf9] text-gray-800 flex flex-col min-h-screen">

    <!-- NAVBAR LEVEL 1 -->
    <nav class="bg-white border-b">
        <div class="flex items-center justify-center px-4 py-3 mx-auto max-w-7xl">
            <div class="font-serif text-2xl font-bold tracking-wide text-gray-900">
                TUNué
            </div>
        </div>
    </nav>

    <nav class="bg-[#fefaf6] shadow-sm" x-data="{ open: false }">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-7xl">
            <!-- KIRI: LOGIN -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <span class="text-sm text-gray-700 me-4">
                        Halo, {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline hover:text-red-800">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline hover:text-black">
                        Login
                    </a>
                @endauth
            </div>



            <!-- KANAN (DESKTOP): Menu -->
            <ul class="items-center hidden gap-6 text-sm font-medium text-gray-700 md:flex">
                <li><a href="{{ url('/') }}" class="hover:text-black">Home</a></li>
                <li><a href="{{ route('produk.index') }}" class="hover:text-black">Shop</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-black">About Us</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-black">Contact</a></li>
                <li><a href="{{ route('orders.index') }}" class="hover:text-black">My Orders</a></li>
                <li><a href="{{ route('rating.index') }}" class="hover:text-black">Rate</a></li>
                <li>
                    <a href="{{ route('cart.index') }}" class="text-xl hover:text-black">
                        🛒
                    </a>
                </li>
            </ul>

            <!-- KANAN (MOBILE): Hamburger -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- MOBILE MENU DROPDOWN -->
        <div x-show="open" class="bg-white border-t md:hidden">
            <ul class="px-4 py-2 space-y-2 text-sm text-gray-700">
                <li><a href="{{ url('/') }}" class="block hover:text-black">Home</a></li>
                <li><a href="{{ route('produk.index') }}" class="block hover:text-black">Shop</a></li>
                <li><a href="{{ url('/about') }}" class="block hover:text-black">About Us</a></li>
                <li><a href="{{ url('/contact') }}" class="block hover:text-black">Contact</a></li>
                <li><a href="{{ route('orders.index') }}" class="block hover:text-black">My Orders</a></li>
                <li><a href="{{ route('rating.index') }}" class="block hover:text-black">Rate</a></li>
                <li><a href="{{ route('cart.index') }}" class="block hover:text-black">🛒 Keranjang</a></li>
            </ul>
        </div>
    </nav>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#fdfaf5] text-center text-sm text-gray-600 py-4 mt-auto">
        &copy; © 2025 TUNué. All rights reserved.
    </footer>
</body>

</html>

{{-- Livewire Scripts --}}
@livewireScripts

{{-- ---------- Wilayah (Dropdown alamat) ---------- --}}
<script>
    let dataWilayah = {};

    async function loadWilayah() {
        const res = await fetch("/json/wilayah.json");
        dataWilayah = await res.json();
        populateSelect("province", Object.keys(dataWilayah));
    }

    function populateSelect(id, options) {
        const select = document.getElementById(id);
        if (!select) return;
        select.innerHTML = '<option value="">-- Pilih --</option>';
        options.forEach(opt => {
            const o = document.createElement("option");
            o.value = opt;
            o.text = opt;
            select.appendChild(o);
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        loadWilayah();

        document.getElementById("province")?.addEventListener("change", e => {
            const prov = e.target.value;
            populateSelect("city", prov ? Object.keys(dataWilayah[prov]) : []);
            populateSelect("district", []);
            populateSelect("village", []);
        });

        document.getElementById("city")?.addEventListener("change", e => {
            const prov = document.getElementById("province").value;
            const city = e.target.value;
            populateSelect("district", prov && city ? Object.keys(dataWilayah[prov][city]) : []);
            populateSelect("village", []);
        });

        document.getElementById("district")?.addEventListener("change", e => {
            const prov = document.getElementById("province").value;
            const city = document.getElementById("city").value;
            const district = e.target.value;
            populateSelect("village", prov && city && district ? dataWilayah[prov][city][district] :
        []);
        });
    });
</script>

{{-- Jika pakai file eksternal wilayah.js --}}
{{-- <script src="{{ asset('js/wilayah.js') }}"></script> --}}
</body>

</html>
