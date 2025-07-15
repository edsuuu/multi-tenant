<?php

declare(strict_types=1);

use App\Http\Controllers\AuthProvidersController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', static function () {
        echo 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    })->name('home-tenant');

    Route::get('/auth/redirect/{token}', [AuthProvidersController::class, 'authTenant'])->name('auth-redirect');

    Route::get('/completar-perfil', function () {
        return view('scheduling.auth.complete-profile');
    })->name('complete-profile');

    Route::middleware(['auth', 'web'])->group(function () {
        Route::view('dashboard', 'scheduling.dashboard.dashboard')->name('dashboard');
        Route::view('usuarios', 'scheduling.users.users')->name('users');


        Route::view('produtos', 'scheduling.catalog.products')->name('products');
        Route::view('procedimentos', 'scheduling.catalog.procedures')->name('procedures');
        Route::view('perfil', 'scheduling.profile.profile')->name('profile');
        Route::view('meu-link', 'scheduling.business.business')->name('link-business');
    });
});
