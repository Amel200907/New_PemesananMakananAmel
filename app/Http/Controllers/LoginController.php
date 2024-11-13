<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        return redirect()->intended(route('menu.index')); 
    }

    return redirect()->route('login')->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
