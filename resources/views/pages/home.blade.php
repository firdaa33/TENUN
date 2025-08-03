@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<section class="w-full bg-[#fdfaf5] px-4 py-6 sm:py-8">
  <div class="max-w-6xl mx-auto grid grid-cols-2 items-center">
    
    <!-- Teks -->
    <div class="pl-1 sm:pl-6 pr-2 sm:pr-8 text-[#5c3a1c]">
      <p class="text-xs sm:text-sm font-medium mb-1">Belanja</p>
      <h1 class="text-base sm:text-2xl md:text-3xl font-bold leading-snug mb-3">
        Kain tenun<br>Khas desa Pringgasela
      </h1>
      <a href="{{ route('produk.index') }}"
         class="inline-block px-2 py-1 sm:px-4 sm:py-2 border border-black text-black text-[10px] sm:text-sm font-semibold rounded hover:bg-black hover:text-white transition">
        Belanja Sekarang
      </a>
    </div>

    <!-- Gambar -->
    <div class="flex justify-end">
      <img src="{{ asset('images/a.jpg') }}"
           alt="Tenun"
           class="w-[120px] sm:w-[200px] md:w-[350px] h-auto object-cover object-center">
    </div>
  </div>
</section>

  <!-- Kalimat Pembuka 2 -->
<section class="bg-white py-8 px-4">
  <div class="max-w-2xl mx-auto text-center">
    <p class="text-[#5c3a1c] text-sm sm:text-base leading-relaxed sm:leading-7 tracking-normal">
      Tenun Pringgasela bukan hanya sekedar kain, tetapi juga warisan budaya yang terus hidup setiap helainya.
    </p>
  </div>
</section>

<!-- Kelebihan Produk Tenun -->
<section class="bg-[#fdfaf5] py-10 px-4">
  <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-6 max-w-6xl mx-auto">
    <!-- Box -->
    <div class="bg-white p-3 sm:p-6 rounded-xl shadow text-center">
      <img src="/images/1.jpg" alt="Buatan Tangan" class="w-6 h-6 sm:w-10 sm:h-10 mx-auto mb-2 sm:mb-3">
      <h3 class="text-sm sm:text-md font-semibold text-[#5c3a1c] mb-1">Buatan Tangan</h3>
      <p class="text-xs sm:text-sm text-gray-600">Ditenun oleh pengrajin lokal.</p>
    </div>

    <div class="bg-white p-3 sm:p-6 rounded-xl shadow text-center">
      <img src="/images/2.jpg" alt="Kualitas Premium" class="w-6 h-6 sm:w-10 sm:h-10 mx-auto mb-2 sm:mb-3">
      <h3 class="text-sm sm:text-md font-semibold text-[#5c3a1c] mb-1">Kualitas Premium</h3>
      <p class="text-xs sm:text-sm text-gray-600">Serat benang kuat & tahan lama.</p>
    </div>

    <div class="bg-white p-3 sm:p-6 rounded-xl shadow text-center">
      <img src="/images/3.jpg" alt="Nilai Budaya" class="w-6 h-6 sm:w-10 sm:h-10 mx-auto mb-2 sm:mb-3">
      <h3 class="text-sm sm:text-md font-semibold text-[#5c3a1c] mb-1">Nilai Budaya</h3>
      <p class="text-xs sm:text-sm text-gray-600">Motif penuh sejarah dan filosofi.</p>
    </div>

    <div class="bg-white p-3 sm:p-6 rounded-xl shadow text-center">
      <img src="/images/tenun4.jpg" alt="Unik & Eksklusif" class="w-6 h-6 sm:w-10 sm:h-10 mx-auto mb-2 sm:mb-3">
      <h3 class="text-sm sm:text-md font-semibold text-[#5c3a1c] mb-1">Unik & Eksklusif</h3>
      <p class="text-xs sm:text-sm text-gray-600">Setiap tenun terbatas & berbeda.</p>
    </div>
  </div>
</section>

@endsection
