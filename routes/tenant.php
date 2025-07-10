<?php

declare(strict_types=1);

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Route;
//use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
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
])->group(function ($request) {
//    Route::get('/', function () {
//        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
//    });
    Route::get('/', function (Request $request) {

        echo 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');

        $explode = explode('.', $request->getHost());

        if (count($explode) > 1 && $explode[0] !== config('app.url')) {
//            return redirect(config('app.url'));
        }
    })->name('home-tenant');

    Route::get('/auth/redirect/{token}', static function ($token) {
        try {
            $data = decrypt($token);

            if (now()->gt($data['expires'])) {
                abort(403, 'Token expirado');
            }

            $user = \App\Models\User::findOrFail($data['user_id']);
            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
    })->name('auth-redirect');

    Route::get('/completar-perfil', function () {
        return view('scheduling.auth.complete-profile');
    })->name('complete-profile');

    Route::middleware(['auth'])->group(function () {
        Route::view('dashboard', 'scheduling.dashboard.dashboard')->name('dashboard');
        Route::view('produtos', 'scheduling.catalog.products')->name('products');
        Route::view('procedimentos', 'scheduling.catalog.procedures')->name('procedures');
        Route::view('perfil', 'scheduling.profile.profile')->name('profile');
        Route::view('meu-link', 'scheduling.business.business')->name('link-business');
    });
});
