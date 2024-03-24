<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\GoogleAuthController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');


require __DIR__.'/adminauth.php';

Route::name('/')->group(function () {
    Route::get('/about', function () {
        return view("about");
    })->name('about');
    Route::get('/services', function () {
        return view("services");
    })->name('services');
    Route::get('/contact', function () {
        return view("contact");
    })->name('contact');
});


Route::get('google-auth', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle'])->name('google-callback');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);



Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('ADMIN_DASHBOARD');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::patch('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
});





