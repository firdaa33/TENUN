<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua pesanan milik user
   public function index()
    {
    $orders = Order::with('items', 'return_request')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('pages.orders', compact('orders'));
    }

    // Konfirmasi oleh admin/user
    public function confirm(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->update(['status' => 'selesai']);

        return redirect()->route('orders.index')->with('success', 'Pesanan telah dikonfirmasi!');
    }

    // Konfirmasi oleh user dan redirect ke produk untuk memberi rating
    public function userConfirm(Order $order)
    {
    // Pastikan hanya user yang berhak bisa konfirmasi pesanan miliknya
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    if ($order->status !== 'dikirim') {
        return redirect()->back()->with('error', 'Pesanan belum bisa dikonfirmasi.');
    }

    $order->status = 'selesai';
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Pesanan dikonfirmasi telah diterima.');
    }

    // Upload bukti transfer
    public function uploadBukti(Request $request, Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $request->validate([
            'bukti_transfer' => 'required|image|max:2048',
        ]);

        $file = $request->file('bukti_transfer');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti-transfer'), $filename);

        $order->bukti_transfer = 'uploads/bukti-transfer/' . $filename;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Bukti pembayaran berhasil diupload. Pesanan akan diproses oleh admin.');
    }

    // Tampilkan invoice setelah transfer
    public function showInvoice(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('user.orders.invoice', compact('order'));
    }

    public function destroy(Order $order)
    {
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    $order->delete();
    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

}
