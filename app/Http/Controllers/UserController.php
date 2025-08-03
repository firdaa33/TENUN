<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function editAlamat()
    {
        $user = Auth::user();
        return view('pages.profile.edit', compact('user'));
    }

    public function updateAlamat(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->alamat = $request->alamat;
        $user->save();

        return redirect()->route('checkout')->with('success', 'Alamat berhasil diperbarui.');
    }
}
