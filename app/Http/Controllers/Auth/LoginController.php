<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Ambil redirect dari form, default ke 'home'
            $redirect = $request->input('redirect', 'home');

            // Tentukan tujuan redirect berdasarkan asal login
            switch ($redirect) {
                case 'checkout':
                    return redirect()->route('checkout');
                case 'home':
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // balik ke home
    }
}
