<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    //
    // Menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'] ?? 'Anonymous', // Tambahkan nilai default
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
