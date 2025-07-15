<?php

use App\Http\Controllers\AuthProvidersController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        require __DIR__.'/auth.php';

        Route::view('/', 'scheduling.home-page')->name('home');

        Route::middleware(['auth','web'])->group(function () {
            Route::view('dashboard', 'scheduling.dashboard.dashboard')->name('dashboard');
            Route::view('tenants', 'scheduling.tenants.tenants')->name('tenants');
            Route::view('usuarios', 'scheduling.users.users')->name('users');

        });
    });

    Route::post('logout', [AuthProvidersController::class, 'logout'])->name('logout');
}
