<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('layouts.login');
    }

    public function login_proses(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'role' => 'Role pengguna tidak dikenali!',
            ]);
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah!',
    ])->onlyInput('email');
}

}