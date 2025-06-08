<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            if ($user->role === 'staf') {
                return redirect()->route('halaman_dashboard');
            } elseif ($user->role === 'staf_gudang') {
                return redirect()->route('dashboard_admin');
            } else {
                Auth::logout();
                return redirect('/')->withErrors(['login' => 'Role tidak dikenali.']);
            }
        } else {
            return redirect()->back()
                ->withErrors(['login' => 'Email atau password tidak sesuai'])
                ->withInput();
        }
    }
}
