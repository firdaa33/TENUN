@extends('layouts.customer')

@section('content')
    <section class="relative bg-[#ffffff]">
        <!-- Hero Image dengan overlay teks -->
        <div class="relative w-full h-64 sm:h-80 md:h-[500px] overflow-hidden">
            <img src="{{ asset('images/a.jpg') }}" alt="Hero Image" class="object-cover w-full h-full" />
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <!-- Judul + CTA di atas gambar -->
            <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center">
                <h1 class="mb-4 text-2xl font-normal tracking-wider text-white uppercase sm:text-3xl md:text-5xl"
                    style="font-family: 'Playfair Display', serif;">
                    Berawal dari benang, menjadi cerita
                </h1>
                <div class="flex flex-row flex-wrap justify-center gap-3">
                    <a href="#shop"
                        class="inline-block px-5 py-3 text-xs font-semibold tracking-wider text-black uppercase transition bg-white rounded hover:bg-gray-100">
                        Lihat Koleksi
                    </a>
                    <a href="{{ route('about') }}"
                        class="inline-block px-5 py-3 text-xs font-semibold tracking-wider text-white uppercase transition bg-transparent border border-white rounded hover:bg-white hover:text-black">
                        Cerita Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Subjudul di bawah gambar -->
        <div class="max-w-3xl px-4 py-8 mx-auto text-center sm:py-12 sm:px-6">
            <p class="text-sm leading-relaxed text-gray-700 sm:text-base md:text-lg"
                style="font-family: 'Open Sans', sans-serif;">
                Sebuah cerita tak hanya bisa dibaca. Ia bisa dirasakan lewat tekstur, warna, dan sentuhan tangan pengerajin.
                Selamat datang di TUNué, tempat dimana kisah tradisi berubah menjadi gaya yang hidup.
            </p>
        </div>
    </section>

    {{-- Section: Kelebihan Produk Kami --}}
    <section class="bg-[#fdfaf5] py-12 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="mb-10 text-xl font-semibold sm:text-2xl md:text-3xl" style="font-family: 'Playfair Display', serif;">
                Kelebihan Produk Kami
            </h2>
            <div class="grid grid-cols-1 gap-6 text-left sm:grid-cols-2 md:grid-cols-3 sm:gap-8">
                <!-- Card 1 -->
                <div class="p-4 transition bg-white shadow sm:p-6 rounded-xl hover:shadow-md">
                    <div class="mb-3 text-3xl sm:text-4xl">🧶</div>
                    <h3 class="mb-1 text-base font-semibold sm:text-lg">Tenunan Tangan Asli</h3>
                    <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
                        Dikerjakan manual oleh pengerajin lokal dengan penuh makna.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-4 transition bg-white shadow sm:p-6 rounded-xl hover:shadow-md">
                    <div class="mb-3 text-3xl sm:text-4xl">🌿</div>
                    <h3 class="mb-1 text-base font-semibold sm:text-lg">Bahan Ramah Lingkungan</h3>
                    <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
                        Menggunakan serat alami dan pewarna organik.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-4 transition bg-white shadow sm:p-6 rounded-xl hover:shadow-md">
                    <div class="mb-3 text-3xl sm:text-4xl">🎁</div>
                    <h3 class="mb-1 text-base font-semibold sm:text-lg">Kualitas Premium</h3>
                    <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
                        Nyaman dan tahan lama, cocok untuk diwariskan.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection