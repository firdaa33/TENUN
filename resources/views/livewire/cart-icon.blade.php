<a href="{{ route('cart.index') }}" class="relative block">
    <svg class="w-6 h-6 text-[#5E2C1F]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4L7 13zm0 0l1.5 7h9l1.5-7M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
    </svg>
    @if($count > 0)
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full text-center leading-5">
            {{ $count }}
        </span>
    @endif
</a>
