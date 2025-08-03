<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    protected $fillable = [
    'order_id',
    'user_id',
    'reason',
    'image',
];
   public function create(Order $order)
{
    // Pastikan order milik user yang sedang login
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('returns.create', compact('order'));
}

    public function store(Request $request, Order $order)
{
    // Validasi input
    $request->validate([
        'reason' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    // Simpan file jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $namaBaru = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/returns'), $namaBaru);
        $imagePath = 'uploads/returns/' . $namaBaru;
    }

    // Simpan ke database
    ReturnRequest::create([
    'order_id' => $order->id,
    'user_id' => auth()->id(),
    'reason' => $request->reason,
    'image' => $imagePath,
]);


    return redirect()->route('orders.index')->with('success', 'Pengajuan pengembalian berhasil dikirim.');
    }

}
