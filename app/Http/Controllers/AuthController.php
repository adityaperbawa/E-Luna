<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('home'); 
        }

        return view('auth.login');
    }


    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Simpan notifikasi flash ke session
            $request->session()->flash('success_title', 'Selamat datang');
            $request->session()->flash('success_user', Auth::user()->name);

            // Arahkan langsung ke route home (bukan intended)
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logout_success', 'Berhasil Log Out');
    }


}
