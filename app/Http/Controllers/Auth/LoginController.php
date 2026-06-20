<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        
        // Redirect based on role
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role === 'cashier') {
            return redirect('/pos');  // Cashier goes to POS
        }
        
        return redirect('/pos');  // Customer also goes to POS
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}