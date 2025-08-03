<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
{
    $ratings = Rating::where('is_approved', true)
                ->latest()
                ->with('user', 'product')
                ->get();

    return view('ratings.index', compact('ratings'));
}

    public function create($product_id)
{
    $product = Product::findOrFail($product_id);
    return view('rating.form', compact('product'));
}

public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

   Rating::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
        'is_approved' => false, // default: pending
    ]);

    return redirect()->route('orders.index')->with('success', 'Terima kasih atas rating-nya!');
}

}
