<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthProvidersController;

Route::view('cadastro', 'scheduling.auth.register')->name('register');

Route::middleware('guest')->group(function () {
    Route::view('login', 'scheduling.auth.login')->name('login');
    Route::view('esqueci-senha', 'scheduling.auth.forgot-password')->name('forgot-password');
    Route::view('resetar-senha/{token}', 'scheduling.auth.reset-password')->name('password.reset');
});

Route::middleware('web')->get('oauth2/google', [AuthProvidersController::class, 'googleAuth'])->name('google');
Route::middleware('web')->get('oauth2/google/callback', [AuthProvidersController::class, 'googleCallback']);
