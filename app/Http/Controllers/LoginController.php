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
            return redirect()->route(auth()->user()->is_admin ? 'admin.dashboard' : 'menu.index');
        }
    
        return back()->withErrors(['email' => 'Email or password is incorrect.']);
    }
    

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
