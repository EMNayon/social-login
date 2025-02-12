<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;

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

// google login
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// facebook login
Route::get('auth/facebook', [FacebookAuthController::class, 'redirect'])->name('facebook-auth');
Route::get('auth/facebook/call-back', [FacebookAuthController::class, 'callbackFacebook']);

// github login
Route::get('auth/github', [GithubAuthController::class, 'redirect'])->name('github-auth');
Route::get('auth/github/call-back', [GithubAuthController::class, 'callbackGithub']);


require __DIR__.'/auth.php';
