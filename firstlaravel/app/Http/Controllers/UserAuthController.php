<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class UserAuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        // Logic for user login
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user record
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
        ]);

        return redirect()->route('user.dashboard');
    }
}
