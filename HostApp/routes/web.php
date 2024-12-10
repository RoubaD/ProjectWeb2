<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PropertyDetailsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

Route::get('/destinations', function () {
    return view('destinations');
})->name('destinations');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    // Route::get('/register', function () {
    //     return view('auth.register');
    // })->name('register');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']); // Ensure this line is present

});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('login/google', [SocialLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);

// Profile Management (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//desitnations routes
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations');
Route::get('/destinations/{id}/reserved-dates', [DestinationController::class, 'getReservedDates']);
Route::post('/destinations/{id}/reserve', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('/search', [DestinationController::class, 'search'])->name('search');
Route::get('/map-search', [DestinationController::class, 'mapSearch'])->name('map.search');

Route::get('/detailedSearch', [SearchController::class, 'detailedSearch'])->name('detailedSearch');
Route::get('/destinations/{id}', [PropertyDetailsController::class, 'show'])->name('destinations.show');
Route::get('/destinations/{id}/reserved-dates', [PropertyDetailsController::class, 'getReservedDates'])->name('destinations.reservedDates');

Route::get('/api/check-auth', function () {
    return response()->json(['authenticated' => Auth::check()]);
});


// Auth routes (registration, login, etc.)
//require __DIR__.'/auth.php';