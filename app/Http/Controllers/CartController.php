<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = session()->get('cart', []);
        return view('pages.cart', compact('carts'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        $checkoutItems = session()->get('checkout_items', []);

        unset($cart[$id]);
        $checkoutItems = array_filter($checkoutItems, fn($itemId) => $itemId != $id);

        session()->put('cart', $cart);
        session()->put('checkout_items', array_values($checkoutItems)); // reset index

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        session()->forget('checkout_items');

        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}
