<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view()
    {
        return view("login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $infologin= [
        'email'=> $request->email,
        'password'=> $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // if (Auth::User()->role == 'staf') {
            //     // return redirect ('/admin);
            // } elseif(Auth::User()->role == 'staf') {
            //     // return redirect ('/admin);
            // }
            return redirect ('/halaman_dashboard');
            // echo 'sukses';exit(); // hanya untuk debug, jangan lupa hapus kalau sudah tidak perlu
        } else {
            return redirect()->back()
                ->withErrors(['login' => 'Email atau password tidak sesuai'])
                ->withInput();
        }
    }

}
