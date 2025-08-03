<?php

namespace App\Http\Controllers;use App\Models\Product;
class HomeController extends Controller{public function __invoke(){ $latest=Product::latest()->take(4)->get();return view('pages.home',compact('latest'));}
public function index()
{
    $products = Product::latest()->take(4)->get(); // ambil 4 produk terbaru
    return view('pages.home', compact('products'));
}
}