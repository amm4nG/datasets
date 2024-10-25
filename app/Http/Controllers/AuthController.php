<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function validation(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Harap masukkan email',
            'password.required' => 'Harap masukkan password',
        ]);

        $credential = $request->only('email', 'password');
        $user = User::where('email', $credential['email'])->first();
        if ($user && !is_null($user->password)) {
            if (Auth::attempt($credential)) {
                $user = Auth::user();
                if ($user->role == 'admin') {
                    return redirect()->intended('admin/dashboard');
                }
                return redirect()->intended('/');
            }
        }
        return back()->withErrors([
            'message' => 'Email atau password Anda salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
