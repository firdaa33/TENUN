@extends('layouts.customer')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">

    <div class="grid md:grid-cols-2 gap-12 items-center">
        {{-- KIRI: VIDEO EMBED --}}
        <div class="w-full aspect-square max-w-md mx-auto rounded-md overflow-hidden shadow-lg border border-gray-200">
            <iframe 
                class="w-full h-full"
                src="https://www.youtube.com/embed/PmEZW1c6zy4"
                title="Proses Tenun Tradisional"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        {{-- KANAN: TEKS SEJARAH --}}
        <div>
            <h1 class="text-3xl md:text-2xl font-bold text-gray-900 mb-4 leading-tight">
                Melestarikan Warisan Lewat Tenun Pringgasela
            </h1>
            <p class="text-gray-700 text-sm md:text-base leading-relaxed mb-6">
                Tenun Pringgasela adalah kerajinan tenun tradisional khas Desa Pringgasela, Lombok Timur, NTB. 
                Dikenal dengan motif garis memanjang dan pewarna alami dari akar-akaran, kain ini menjadi identitas masyarakat adat Sasak. 
                Diajarkan secara turun-temurun sejak zaman nenek moyang, tenun ini bukan hanya produk, tapi juga warisan budaya yang hidup. 
                Kain tenun bermotif memanjang menjadi ciri khas Tenun Pringgasela dan menjadi identitas yang unik dan membedakannya.
            </p>
            <p class="text-[#5E2C1F] font-bold text-sm poppins mb-6">
                “Dengan membeli produk kami, kamu turut melestarikan budaya Indonesia dan mendukung pengrajin lokal untuk terus berkarya.”
            </p>
        </div>
    </div>

    {{-- CTA dan IG + Kontak sejajar --}}
<div class="flex flex-wrap items-center gap-4 mt-6">

    {{-- Tombol Jelajahi --}}
    <a href="{{ route('produk.index') }}" class="bg-[#5E2C1F] text-white px-5 py-2 rounded hover:bg-[#7b4535] text-sm font-medium transition">
        Jelajahi Koleksi
    </a>

    {{-- Instagram --}}
    <a href="https://www.instagram.com/selaweave/" target="_blank" class="flex items-center space-x-2 text-[#5E2C1F] text-sm hover:text-[#7b4535] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm4.75-.75a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <span>@selaweave</span>
    </a>

    {{-- Kontak Person --}}
    <a href="https://wa.me/6285974139677" target="_blank" class="flex items-center space-x-2 text-[#5E2C1F] text-sm hover:text-[#7b4535] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20.52 3.48A11.79 11.79 0 0 0 12 0a11.79 11.79 0 0 0-8.52 3.48A11.79 11.79 0 0 0 0 12c0 2.1.54 4.13 1.56 5.94L0 24l6.17-1.61A11.87 11.87 0 0 0 12 24c6.62 0 12-5.38 12-12a11.79 11.79 0 0 0-3.48-8.52zM12 21.5c-1.72 0-3.4-.44-4.9-1.27l-.35-.2-3.67.96.98-3.59-.22-.36A9.52 9.52 0 0 1 2.5 12a9.5 9.5 0 0 1 19 0c0 5.25-4.25 9.5-9.5 9.5zm5.35-7.03c-.3-.15-1.77-.87-2.04-.96-.27-.09-.47-.15-.67.15-.2.3-.77.96-.95 1.16-.17.2-.35.23-.65.08-.3-.15-1.26-.46-2.4-1.46-.89-.79-1.49-1.76-1.67-2.06-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.07-.15-.67-1.61-.91-2.21-.24-.6-.48-.52-.67-.52h-.56c-.18 0-.47.07-.72.35s-.95.93-.95 2.26c0 1.33.98 2.62 1.12 2.8.13.18 1.93 2.95 4.68 4.14.65.28 1.15.45 1.54.58.65.21 1.24.18 1.7.11.52-.08 1.6-.65 1.83-1.28.23-.63.23-1.17.17-1.28-.06-.11-.23-.18-.53-.33z"/>
        </svg>
        <span>+6285974139677</span>
    </a>
</div>


</div>
@endsection
