@php
    $filename = str_replace('uploads/returns/', '', $getState());
@endphp

@if ($filename)
    <img src="{{ asset('uploads/returns/' . $filename) }}" alt="Bukti" class="w-16 h-auto rounded shadow">
@else
    <span class="text-gray-500 italic">Tidak ada gambar</span>
@endif
