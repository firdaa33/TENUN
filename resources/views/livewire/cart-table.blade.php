<div class="space-y-4">
    {{-- Desktop View --}}
    <div class="hidden md:block">
        <table class="w-full border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Pilih</th>
                    <th class="p-3">Produk</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Subtotal</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $id => $item)
                    <tr class="border-t">
                        <td class="p-3">
                            <input type="checkbox" wire:click="toggleSelection({{ $id }})" {{ in_array($id, $selected) ? 'checked' : '' }}>
                        </td>
                        <td class="p-3 flex items-center gap-3">
                            <img src="{{ asset($item['image']) }}" class="w-16 h-16 object-cover rounded">
                            <span>{{ $item['name'] }}</span>
                        </td>
                        <td class="p-3">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="p-3">
                            <input type="number" wire:change="updateQuantity({{ $id }}, $event.target.value)" value="{{ $item['quantity'] }}" min="1" class="w-16 border text-center">
                        </td>
                        <td class="p-3">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td class="p-3">
                            <button wire:click="removeItem({{ $id }})" class="text-red-500 hover:underline text-sm">Hapus</button>
                        </td>
                    </tr>
                @endforeach

                <tr class="font-bold bg-gray-100 border-t">
                    <td colspan="4" class="p-3 text-right">Total yang Dipilih:</td>
                    <td colspan="2" class="p-3">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Mobile View --}}
    <div class="md:hidden space-y-4">
        @foreach ($carts as $id => $item)
            <div class="border rounded-lg shadow-sm p-4 space-y-2">
                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:click="toggleSelection({{ $id }})" {{ in_array($id, $selected) ? 'checked' : '' }}>
                    <img src="{{ asset($item['image']) }}" class="w-16 h-16 object-cover rounded">
                    <div class="flex-1">
                        <p class="font-semibold">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-600">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" wire:change="updateQuantity({{ $id }}, $event.target.value)" value="{{ $item['quantity'] }}" min="1" class="w-16 border rounded text-center">
                    </div>
                    <div class="text-right">
                        <p>Subtotal:</p>
                        <p class="font-semibold">Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="text-right">
                    <button wire:click="removeItem({{ $id }})" class="text-red-500 text-sm hover:underline">Hapus</button>
                </div>
            </div>
        @endforeach

        {{-- Total --}}
        <div class="border-t pt-4 text-right font-semibold">
            Total yang Dipilih: Rp{{ number_format($total, 0, ',', '.') }}
        </div>
    </div>

    {{-- Checkout Button --}}
    @if(count($selected) > 0)
        <div class="text-right mt-4">
            <a href="{{ route('checkout') }}"
   class="bg-[#7C563D] text-white px-6 py-2 rounded hover:bg-[#6a4a34] transition">
   Checkout
    </a>
        </div>
    @endif
</div>
