<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
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
    InitializeTenancyByDomain::class,
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
    });
});
