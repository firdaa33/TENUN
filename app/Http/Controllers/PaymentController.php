<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PaymentController extends Controller
{
    public function uploadProof(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Cek apakah user pemilik order
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Kamu tidak boleh mengakses invoice ini.');
        }

        // Validasi file
        $request->validate([
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('proof')) {
            // Hapus file lama jika ada
            if ($order->bukti_transfer && file_exists(public_path($order->bukti_transfer))) {
                unlink(public_path($order->bukti_transfer));
            }

            // Simpan file ke public/uploads/bukti-transfer
            $file = $request->file('proof');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/bukti-transfer/' . $filename;
            $file->move(public_path('uploads/bukti-transfer'), $filename);

            // Update order
            $order->update([
                'bukti_transfer' => $path,
                'status' => 'menunggu konfirmasi',
            ]);
        }

        return redirect()->route('user.invoice', $order->id)
            ->with('success', 'Bukti pembayaran berhasil diunggah. Tunggu konfirmasi dari admin.');
    }
}
