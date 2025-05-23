<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Perbaikan 2: Gunakan Auth facade dengan proper error handling
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                // Perbaikan 3: Pastikan route 'dashboard' ada
                return redirect()->intended(route('dashboard'));
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        // Perbaikan 4: Tambahkan request untuk session handling
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}