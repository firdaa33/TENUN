<?php

namespace App\Livewire;

use Livewire\Component;

class CartTable extends Component
{
    public $carts = [];
    public $selected = [];

    public function mount()
    {
        $this->carts = session()->get('cart', []);
        $this->selected = session()->get('checkout_items', []);
    }

    public function updateQuantity($id, $quantity)
    {
        if (isset($this->carts[$id])) {
            $this->carts[$id]['quantity'] = (int) $quantity;
            session()->put('cart', $this->carts);
        }

        $this->refreshTotal();
    }

    public function toggleSelection($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_values(array_diff($this->selected, [$id]));
        } else {
            $this->selected[] = $id;
        }

        session()->put('checkout_items', $this->selected);
    }

    public function removeItem($id)
    {
        unset($this->carts[$id]);
        session()->put('cart', $this->carts);

        $this->selected = array_values(array_diff($this->selected, [$id]));
        session()->put('checkout_items', $this->selected);
    }

    public function refreshTotal()
    {
        session()->put('cart', $this->carts);
    }

    public function render()
    {
        $total = 0;
        foreach ($this->selected as $id) {
            if (isset($this->carts[$id])) {
                $total += $this->carts[$id]['price'] * $this->carts[$id]['quantity'];
            }
        }

        return view('livewire.cart-table', [
            'carts' => $this->carts,
            'selected' => $this->selected,
            'cartCount' => count($this->carts),
            'total' => $total,
        ]);
    }
}
