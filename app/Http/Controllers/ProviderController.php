<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function GitHubLogin()
    {

        return Socialite::driver('github')->redirect();
    }

    public function callbackFromGithub()
    {

        $user = Socialite::driver('github')->stateless()->user();
        $finduser = User::where('github_id', $user->id)->first();
        if ($finduser) {
            Auth::login($finduser);
            return redirect()->intended('dashboard');
        } else {
            $newuser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'github_id' => $user->id,
                'password' => encrypt('123456')

            ]);
            Auth::login($newuser);
            return redirect()->intended('dashboard');
        }
    }


    // GoogleLogin

    public function GoogleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function callbackFromGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $FindUser = User::where('google_id', $user->id)->first();

         if ($FindUser) {
            Auth::login($FindUser);
            return redirect()->intended('dashboard');
        } else {
            $NewUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => encrypt('123456')

            ]);
            Auth::login($NewUser);
            return redirect()->intended('dashboard');
        }
}
}
