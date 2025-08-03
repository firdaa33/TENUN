@extends('layouts.customer')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <h2 class="text-xl font-bold mb-4">Pesanan Saya</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Tanggal</th>
                <th class="text-left">Total</th>
                <th class="text-left">Status</th>
                <th class="text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $o)
            <tr class="border-t">
                <td class="p-2">{{ $o->created_at->format('d M Y') }}</td>
                <td>Rp {{ number_format($o->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</td>
                <td>
                    <span class="px-2 py-1 text-sm rounded 
                        {{ $o->status === 'pending' ? 'bg-gray-300 text-gray-800' : 
                           ($o->status === 'selesai' ? 'bg-green-200 text-green-800' : 
                           ($o->status === 'dikirim' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800')) }}">
                        {{ ucfirst($o->status) }}
                    </span>
                </td>
                <td>
                    <div class="flex flex-col gap-2">
                        @if ($o->status === 'dikirim')
                            {{-- Tombol Konfirmasi Pesanan --}}
                            <form method="POST" action="{{ route('orders.user-confirm', $o->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-[#5E2C1F] text-white px-3 py-1 rounded">
                                    Konfirmasi Diterima
                                </button>
                            </form>

                        @elseif ($o->status === 'selesai')
                            {{-- Tombol Beri Rating --}}
                            <a href="{{ route('produk.rating.create', $o->id) }}" class="text-blue-600 hover:underline">
                                Beri Rating
                            </a>

                            {{-- Tombol Ajukan Pengembalian --}}
                            @if (!$o->return_request)
                                <a href="{{ route('returns.create', ['order' => $o->id]) }}"
                                    class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Ajukan Pengembalian
                                </a>
                            @else
                                @php $statusReturn = $o->return_request->status; @endphp
                                @if ($statusReturn === 'pending')
                                    <span class="text-sm text-red-500 italic">Menunggu respon pengembalian</span>
                                @elseif ($statusReturn === 'approved')
                                    <span class="text-sm text-green-600 italic">Pengembalian disetujui</span>
                                @elseif ($statusReturn === 'rejected')
                                    <span class="text-sm text-gray-500 italic">Pengembalian ditolak</span>
                                @else
                                    <span class="text-sm italic text-yellow-700">Status tidak diketahui</span>
                                @endif
                            @endif
                        @else
                            <span class="text-gray-600 text-sm italic">-</span>
                        @endif

                        {{-- Tombol Hapus (bisa di semua kondisi) --}}
                        <form method="POST" action="{{ route('orders.destroy', $o->id) }}"
                            onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-2 text-red-600 hover:underline text-sm">
                                Hapus Pesanan
                            </button>
                        </form>
                        @if (session('success'))
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-4">Belum ada pesanan</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
