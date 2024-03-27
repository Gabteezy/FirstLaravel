<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if the user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // User doesn't exist, create a new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    // Add other fields as needed
                ]);
            }

            // Log in the user
            Auth::login($user);

            // Optionally, set a cookie
            Cookie::queue('auth_token', 'your_auth_token_value', 60);

            // Redirect the user to the intended destination
            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the authentication process
            dd($e->getMessage());
        }
    }
}
