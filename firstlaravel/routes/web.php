<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllerCustom;
use App\Http\Controllers\AdminRegistrationController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;


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




Route::prefix('admin')->group(function () {
    // Registration routes
    Route::get('/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register']);

//     // Login routes
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login']);


});

Route::prefix('user')->middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [UserAuthController::class, 'register']);
});





// Admin dashboard route
Route::get('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminControllerCustom::class, 'dashboard'])->name('admin.dashboard');
    // Route::get('/admin/profile', [App\Http\Controllers\AdminControllerCustom::class, 'profile'])->name('admin.profile');
    // Route::patch('/admin/profile', [App\Http\Controllers\AdminControllerCustom::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/logout', [App\Http\Controllers\AdminControllerCustom::class, 'logout'])->name('admin.logout');
});



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






