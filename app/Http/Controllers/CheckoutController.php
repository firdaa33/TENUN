<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $selectedIds = session()->get('checkout_items', []);

        // Ambil item yang dicentang
        $selectedItems = array_intersect_key($cart, array_flip($selectedIds));

        $total = collect($selectedItems)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('pages.checkout.index', [
            'cart' => $selectedItems,
            'total' => $total,
        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $user = auth()->user();
            $cart = session()->get('cart', []);
            $selectedIds = session()->get('checkout_items', []);

            $selectedItems = array_intersect_key($cart, array_flip($selectedIds));

            if (empty($selectedItems)) {
                return back()->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
            }

            // Validasi alamat
            if (empty($user->alamat) || empty($user->phone)) {
                return back()->with('error', 'Silakan lengkapi alamat dan nomor telepon sebelum checkout.');
            }

            $total_harga = collect($selectedItems)->sum(fn($item) => $item['price'] * $item['quantity']);
            // Simpan order
            $order = Order::create([
                'user_id'        => $user->id,
                'payment_method' => $request->payment_method,
                'status'         => 'pending',
                'phone'          => $user->phone,
                'alamat'         => $user->alamat,
                'total'          => $total_harga,
                'created_at'     => now(),
            ]);

            // Simpan item pesanan
           foreach ($selectedItems as $item) {
                $product = Product::find($item['id']);

                if (!$product) {
                    throw new \Exception("Produk tidak ditemukan.");
                }

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk '{$product->name}' tidak mencukupi. Stok saat ini: {$product->stock}, Quantity dibeli: {$item['quantity']}");
                }

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }


            // Update keranjang & hapus session
            $remainingCart = array_diff_key($cart, array_flip($selectedIds));
            session()->put('cart', $remainingCart);
            session()->forget('checkout_items');

            DB::commit();

            if (strtolower($order->payment_method) === 'cod') {
                return redirect()->route('orders.index')
                    ->with('success', 'Pesanan COD berhasil dibuat!.');
            }

            // untuk selain COD (transfer)
            return redirect()->route('orders.invoice', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
        dd([
        'checkout_items' => session()->get('checkout_items'),
        'cart' => session()->get('cart'),
    ]);
    }

    public function editAlamat()
    {
        return view('pages.checkout.edit-alamat');
    }

    public function updateAlamat(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'province' => 'required|string',
            'city'     => 'required|string',
            'district' => 'required|string',
            'alamat'   => 'required|string', // desa/kelurahan
        ]);

        $alamatLengkap = implode(', ', [
            $request->alamat,     // desa
            $request->district,   // kecamatan
            $request->city,       // kota/kabupaten
            $request->province,   // provinsi
        ]);

        auth()->user()->update([
            'name'   => $request->name,
            'phone'  => $request->phone,
            'alamat' => $alamatLengkap,
        ]);

        return redirect()->route('checkout')->with('success', 'Alamat berhasil diperbarui.');
    }
}
