<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()     { return view('pages.home'); }
    public function produk()   { return view('pages.produk'); }
    public function about()    { return view('pages.about'); }
    public function keranjang(){ return view('pages.keranjang'); }
    public function checkout() { return view('pages.checkout'); }
    public function pesanan()  { return view('pages.pesanan'); }
    public function chat()     { return view('pages.chat'); }
}
