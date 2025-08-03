<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showForm(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'phone'    => 'required',
            'address'  => 'required',
            'province' => 'required',
            'city'     => 'required',
            'district' => 'required',
            'village'  => 'required',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'address'  => $validated['address'],
            'province' => $validated['province'],
            'city'     => $validated['city'],
            'district' => $validated['district'],
            'village'  => $validated['village'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false, // <--- penting!
        ]);

        Auth::login($user);

        // Redirect ke tujuan jika ada, atau default ke home
        return redirect($request->redirect ?? '/');
    }
    protected function create(array $data)
{
    // Gabungkan alamat dari dropdown dan textarea ke satu string
    $alamatLengkap = $data['address'] . ', ' . $data['village'] . ', ' . $data['district'] . ', ' . $data['city'] . ', ' . $data['province'];

    return User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => Hash::make($data['password']),
        'phone'    => $data['phone'],
        'alamat'   => $alamatLengkap,
    ]);
}

protected function validator(array $data)
{
    return Validator::make($data, [
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone'    => ['required', 'string', 'max:20'],
        'province' => ['required', 'string'],
        'city'     => ['required', 'string'],
        'district' => ['required', 'string'],
        'village'  => ['required', 'string'],
        'address'  => ['required', 'string'],
    ]);
}


}
