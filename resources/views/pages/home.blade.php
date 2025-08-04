@extends('layouts.customer')

@section('content')
<section class="relative bg-[#ffffff]">
  <!-- Hero Image dengan overlay teks -->
  <div class="relative w-full h-64 sm:h-80 md:h-[500px] overflow-hidden">
    <img 
      src="{{ asset('images/a.jpg') }}" 
      alt="Hero Image"
      class="w-full h-full object-cover"
    />
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <!-- Judul + CTA di atas gambar -->
    <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center">
      <h1 
        class="text-white text-2xl sm:text-3xl md:text-5xl font-normal uppercase tracking-wider mb-4"
        style="font-family: 'Playfair Display', serif;"
      >
        Berawal dari benang, menjadi cerita
      </h1>
      <div class="flex flex-row flex-wrap justify-center gap-3">
        <a 
          href="#shop" 
          class="inline-block px-5 py-3 bg-white text-black text-xs font-semibold uppercase tracking-wider rounded hover:bg-gray-100 transition"
        >
          Lihat Koleksi
        </a>
        <a 
          href="{{ route('about') }}" 
          class="inline-block px-5 py-3 bg-transparent border border-white text-white text-xs font-semibold uppercase tracking-wider rounded hover:bg-white hover:text-black transition"
        >
          Cerita Kami
        </a>
      </div>
    </div>
  </div>

  <!-- Subjudul di bawah gambar -->
  <div class="max-w-3xl mx-auto py-8 px-4 sm:py-12 sm:px-6 text-center">
    <p 
      class="text-gray-700 text-sm sm:text-base md:text-lg leading-relaxed"
      style="font-family: 'Open Sans', sans-serif;"
    >
      Sebuah cerita tak hanya bisa dibaca. Ia bisa dirasakan lewat tekstur, warna, dan sentuhan tangan pengerajin.
      Selamat datang di TUNué, tempat dimana kisah tradisi berubah menjadi gaya yang hidup.
    </p>
  </div>
</section>

{{-- Section: Kelebihan Produk Kami --}}
<section class="bg-[#fdfaf5] py-12 px-4">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-10" style="font-family: 'Playfair Display', serif;">
      Kelebihan Produk Kami
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 text-left">
      <!-- Card 1 -->
      <div class="p-4 sm:p-6 bg-white rounded-xl shadow hover:shadow-md transition">
        <div class="text-3xl sm:text-4xl mb-3">🧶</div>
        <h3 class="text-base sm:text-lg font-semibold mb-1">Tenunan Tangan Asli</h3>
        <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
          Dikerjakan manual oleh pengerajin lokal dengan penuh makna.
        </p>
      </div>

      <!-- Card 2 -->
      <div class="p-4 sm:p-6 bg-white rounded-xl shadow hover:shadow-md transition">
        <div class="text-3xl sm:text-4xl mb-3">🌿</div>
        <h3 class="text-base sm:text-lg font-semibold mb-1">Bahan Ramah Lingkungan</h3>
        <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
          Menggunakan serat alami dan pewarna organik.
        </p>
      </div>

      <!-- Card 3 -->
      <div class="p-4 sm:p-6 bg-white rounded-xl shadow hover:shadow-md transition">
        <div class="text-3xl sm:text-4xl mb-3">🎁</div>
        <h3 class="text-base sm:text-lg font-semibold mb-1">Kualitas Premium</h3>
        <p class="text-gray-600 text-sm sm:text-[15px] leading-relaxed">
          Nyaman dan tahan lama, cocok untuk diwariskan.
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
