<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $request->authenticate();
    $request->session()->regenerate();

    // Cek asal login dari URL
    if ($request->query('from') === 'checkout') {
        return redirect()->intended('/checkout');
    }

    // Default: dari navbar
    return redirect()->intended('/home');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        // Redirect ke halaman checkout setelah login
        return redirect()->intended('/checkout');
    }

}
