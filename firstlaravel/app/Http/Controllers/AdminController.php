<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        // Logic to display the admin dashboard
        return view('admin.dashboard');
    }

    public function profile()
    {
        // Logic to display the admin profile
        $admin = auth()->guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . auth()->guard('admin')->id(),
            // Add more validation rules as needed
        ]);

        // Update the admin profile
        $admin = auth()->guard('admin')->user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        // Update other profile fields if needed
        $admin->save();

        // Redirect back with success message
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }
}
