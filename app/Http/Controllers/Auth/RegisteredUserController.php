<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
class RegisteredUserController extends Controller
{
    public function Googlelogin(){
        $user = Socialite::driver('google')->user();
        $findUser = User::where('email', $user->email)->first();

        if (!$findUser) {
            $findUser = new User();
            $findUser->name = $user->name;
            $findUser->email = $user->email;
            $findUser->password = bcrypt(Str::random(16)); // Generating a secure random password
            $findUser->dob = '2000-12-12'; // Adjust the format as needed
            $findUser->save();
        }

        session()->put('id', $findUser->id);
        session()->put('type', $findUser->type); // Make sure 'type' is the correct field in your User model
        return redirect('/home');
    }

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
