<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGithubController extends Controller
{
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $user = User::where('github_id', $githubUser->getId())->first();
            if (!$user) {
                $newUser = new User();
                $newUser->full_name = $githubUser->getName();
                $newUser->email = $githubUser->getEmail();
                $newUser->github_id = $githubUser->getId();
                $newUser->role = 'user';
                $newUser->email_verified_at = now();
                $newUser->save();
                Auth::login($newUser);
                return redirect()->intended('/');
            } else {
                Auth::login($user);
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            // echo $th->getMessage();
            return redirect()
                ->route('login')
                ->withErrors([
                    'message' => 'There is an error',
                ]);
        }
    }
}
