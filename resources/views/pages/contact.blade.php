@extends('layouts.customer')

@section('content')
<section class="bg-[#ffffff] py-10 px-4 sm:px-8">
  <div class="max-w-6xl mx-auto">

    {{-- Breadcrumb & Judul --}}
    <div class="mb-10">
      <h2 class="text-3xl font-bold text-center text-[#5f3c0b]">Kontak</h2>
      <p class="text-sm text-center text-gray-500 mb-1">
        <a href="/" class="hover:underline">Home</a> >
        <span class="text-[#5f3c0b]">Kontak</span>
      </p>
    </div>

    {{-- Grid Konten --}}
    <div class="grid md:grid-cols-2 gap-10 md:gap-14 lg:gap-30 items-start">
      
      {{-- Kiri - Info Kontak --}}
      <div class="pl-4 sm:pl-10 lg:pl-12 space-y-6 text-sm sm:text-base">
        
        {{-- Alamat --}}
        <div class="flex items-start gap-4">
          <div class="text-2xl text-[#5f3c0b]">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div>
            <p class="font-semibold text-black text-lg mb-1">Alamat</p>
            <a href="https://maps.google.com/?q=Pringgasela, Lombok Timur" 
               target="_blank" class="hover:underline transition hover:text-[#321912]">
              Jl. Rau, Pringgasela Timur, Kec. Pringgasela, Kabupaten 
              Lombok Timut, Nusa Tenggara Barat.kwk
            </a>
          </div>
        </div>

        {{-- WhatsApp --}}
        <div class="flex items-start gap-4">
          <div class="text-2xl text-[#5f3c0b]">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <div>
            <p class="font-semibold text-black text-lg mb-1">WhatsApp</p>
            <a href="https://wa.me/6287888574096" 
               target="_blank" class="hover:underline transition hover:text-[#321912]">
              +62 8788 857 4096
            </a>
          </div>
        </div>

        {{-- Instagram --}}
        <div class="flex items-start gap-4">
          <div class="text-2xl text-[#5f3c0b]">
            <i class="fa-brands fa-instagram"></i>
          </div>
          <div>
            <p class="font-semibold text-black text-lg mb-1">Instagram</p>
            <a href="https://instagram.com/Tunue11" 
               target="_blank" class="hover:underline transition hover:text-[#321912]">
              @Tunue11
            </a>
          </div>
        </div>

        {{-- Email --}}
        <div class="flex items-start gap-4">
          <div class="text-2xl text-[#5f3c0b]">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div>
            <p class="font-semibold text-black text-lg mb-1">Email</p>
            <a href="mailto:tunue.id11@gmail.com?subject=Halo%20TUNue" 
               class="hover:underline transition hover:text-[#321912]">
              tunue.id11@gmail.com
            </a>
          </div>
        </div>
      </div>

      {{-- Kanan - Maps --}}
      <div class="w-full h-64 sm:h-80 lg:h-[320px] rounded-xl overflow-hidden shadow-lg">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.4262968827563!2d116.53727399999999!3d-8.519622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf7454f715c3%3A0x53a14ec678e0eb5f!2sPringgasela%2C%20Lombok%20Timur!5e0!3m2!1sid!2sid!4v1625903701200!5m2!1sid!2sid"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
    
  </div>
</section>
@endsection
