<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Perbaikan 1: Gunakan Auth facade secara konsisten
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // Cek apakah login berhasil
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke halaman dashboard tanpa cek role
            return redirect('/');
        }

        // Jika login gagal
        Session::flash('status', 'Username atau Password Salah');
        Session::flash('message', 'Username atau Password Salah');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
