<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\ProductReview;

class ProductController extends Controller
{
    // ✅ Menampilkan semua produk (katalog) + pencarian
    public function index(Request $request)
    {
        $q = $request->q;

        $products = Product::when($q, function ($query, $q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(9);

        return view('pages.produk.index', compact('products'));

    }

    // ✅ Menampilkan detail produk (dengan rating + user)
    public function show(Product $product)
    {
        $product->load(['ratings.user']); // agar relasi user ke ratings ikut dimuat
        return view('pages.produk.show', compact('product'));
    }

    // ✅ Menyimpan ulasan produk (optional)
    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        ProductRating::create([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        if ($request->filled('review')) {
            ProductReview::create([
                'product_id' => $id,
                'user_id' => auth()->id(),
                'review' => $request->review,
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Terima kasih telah memberi rating!');
    }

    // ✅ Menyimpan atau update rating
    public function rate(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // ❗ Cek apakah user pernah beli produk ini
        $hasPurchased = auth()->user()
            ->orders()
            ->whereHas('items', function ($q) use ($product) {
                $q->where('product_id', $product->id);
            })->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Kamu hanya bisa memberikan rating jika sudah membeli produk ini.');
        }

        // Simpan atau update rating
        $product->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return redirect()->back()->with('success', 'Terima kasih atas ulasannya!');
    }

}
