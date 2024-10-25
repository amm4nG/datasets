<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'full_name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed'],
            ],
            [
                'full_name.required' => 'Harap masukkan nama lengkap Anda',
                'email.required' => 'Harap masukkan email',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Harap masukkan password',
                'password.confirmed' => 'Harap masukkan konfirmasi password',
            ],
        );

        try {
            $user = new User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'user';
            $user->save();
            $credential = $request->only('email', 'password');
            if (Auth::attempt($credential)) {
                $request->user()->sendEmailVerificationNotification();
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => 'Terjadi kesalahan, silahkan coba lagi',
            ]);
        }
    }
}
