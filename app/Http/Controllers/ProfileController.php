<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.profile.edit', compact('user'));
    }

    /**
     * Update informasi profil user.
     * Bisa dari update umum atau dari halaman checkout (alamat).
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name'   => 'nullable|string|max:255',
            'phone'  => 'nullable|string|max:20',
            'alamat' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Update jika tersedia
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }

        $user->alamat = $request->alamat;
        $user->save();

        return Redirect::route('checkout')->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
