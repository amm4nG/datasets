<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->first();
            if (!$user) {
                $newUser = new User();
                $newUser->full_name = $googleUser->getName();
                $newUser->email = $googleUser->getEmail();
                $newUser->google_id = $googleUser->getId();
                $newUser->role = 'user';
                $newUser->save();
                // $newUser = User::create([
                //     'full_name' => $googleUser->getName(),
                //     'email' => $googleUser->getEmail(),
                //     'google_id' => $googleUser->getId(),
                //     'role' => 'user',
                // ]);
                Auth::login($newUser);
                return redirect('/');
            } else {
                Auth::login($user);
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            // return redirect()
            //     ->route('login')
            //     ->withErrors([
            //         'message' => 'There is an error',
            //     ]);
        }
    }
}
