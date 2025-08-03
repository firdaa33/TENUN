<div class="flex items-center gap-2">
    <button wire:click="$set('quantity', max(1, $quantity - 1))" class="px-2 py-1 bg-gray-200 rounded">-</button>

    <input type="number" min="1" wire:model="quantity" class="w-14 border text-center">

    <button wire:click="$set('quantity', $quantity + 1)" class="px-2 py-1 bg-gray-200 rounded">+</button>

    <div class="ml-4 font-semibold">
        Subtotal: Rp{{ number_format($cart->product->price * $quantity, 0, ',', '.') }}
    </div>
</div>
