<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
// Routes for Authentication (Login, Signup)
Route::get('/', function () {
    return view('access.login');
});
Route::get('/login', function () {
    return view('access.login');
})->name('login');

Route::get('/signup', function () {
    return view('access.signup');
})->name('signup');

// Forgot Password Routes
Route::get('/forgot-password', function () {
    return view('forgot.forgotPassword');
})->name('forgotPassword');

Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password.post');

Route::get('/reset-password/{token}', function ($token, Request $request) {
    return view('forgot.resetPassword', ['token' => $token, 'email' => $request->query('email')]);
})->name('password.reset');

Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password.post');


// Authentication Routes(LOGIN & SIGNUP)
Route::post('/signup', [LoginController::class, 'signup'])->name('signup.post');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Protected Routes with Middleware after login authentication
Route::middleware(['prevent-back-history', 'auth:login'])->group(function () { 
    Route::get('/home', [LoginController::class, 'home'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

    Route::get('chat/{email}', [MessageController::class, 'chat'])->name('chat');
});

