<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllerCustom;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;

// Welcome route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';

// Admin authentication routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Admin registration routes
    Route::get('/register', [AdminRegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AdminRegistrationController::class, 'register'])->name('register.submit');
});

// Admin dashboard route
// Route::middleware(['auth:admin', 'verified'])->group(function () {
//     Route::get('/admin/dashboard', [AdminControllerCustom::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/admin/profile', [AdminControllerCustom::class, 'profile'])->name('admin.profile');
//     Route::patch('/admin/profile', [AdminControllerCustom::class, 'updateProfile'])->name('admin.profile.update');
// });

// Other routes
Route::name('')->group(function () {
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::get('/services', function () {
        return view('services');
    })->name('services');
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
});

// Google authentication routes
Route::get('google-auth', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle'])->name('google-callback');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);



Route::middleware(['custom.admin.auth'])->group(function () {
    
});

Route::get('/admin/dashboard', [AdminControllerCustom::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/profile', [AdminControllerCustom::class, 'profile'])->name('admin.profile');
Route::patch('/admin/profile', [AdminControllerCustom::class, 'updateProfile'])->name('admin.profile.update');
Route::post('/admin/logout', [AdminControllerCustom::class, 'logout'])->name('admin.logout');





