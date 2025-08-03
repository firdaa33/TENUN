<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    // form isi rating
    public function create(Product $product)
    {
        return view('rating.form', compact('product'));
    }

    // simpan rating
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        ProductRating::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('rating.index')->with('success', 'Terima kasih atas ulasannya!');
    }

    // tampil semua rating publik
   public function index()
{
    // Ambil semua rating terbaru, termasuk relasi product & user
    $ratings = \App\Models\ProductRating::with(['product', 'user'])->latest()->get();

    return view('rating.index', compact('ratings'));
}

}
