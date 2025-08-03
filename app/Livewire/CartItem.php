<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class CartItem extends Component
{
    public $cart;
    public $quantity;

    public function mount(Cart $cart)
    {
        $this->cart = $cart;
        $this->quantity = $cart->quantity;
    }

    public function updatedQuantity($value)
    {
        $this->cart->quantity = $value;
        $this->cart->save();
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
