<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminControllerCustom extends Controller
{
    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}