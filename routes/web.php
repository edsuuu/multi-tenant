<?php

use App\Http\Controllers\AuthProvidersController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        require __DIR__.'/auth.php';

        Route::view('/', 'scheduling.home-page')->name('home');

        Route::middleware(['auth'])->group(function () {
            Route::view('produtos', 'scheduling.catalog.products')->name('products');
        });
    });

    Route::post('logout', [AuthProvidersController::class, 'logout'])->name('logout');
}
