<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceUserController extends Controller
{
    public function show($orderId)
    {
        $order = Order::with('items.product')->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.invoice', compact('order'));
    }

    public function uploadBukti(Request $request, $orderId)
    {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Upload bukti transfer
        $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        $order->update([
            'bukti_transfer' => $path,
            'status' => 'menunggu validasi',
        ]);

       return redirect()->route('orders.index')->with('success', 'Bukti transfer berhasil diupload. Menunggu validasi admin.');
    }
}
