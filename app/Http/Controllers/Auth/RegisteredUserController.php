<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required',
            'province' => 'required',
            'city'     => 'required',
            'district' => 'required',
            'village'  => 'required',
            'address'  => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'province' => $request->province,
            'city'     => $request->city,
            'district' => $request->district,
            'village'  => $request->village,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('/checkout');
    }

    public function editAlamat()
    {
        return view('auth.edit-alamat', ['user' => auth()->user()]);
    }

    public function updateAlamat(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        auth()->user()->update([
            'name'   => $request->name,
            'phone'  => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('checkout')->with('success', 'Data berhasil diperbarui.');
    }
}
