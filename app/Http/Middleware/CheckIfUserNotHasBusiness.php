<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserNotHasBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->role !== 'admin') {
                $array = [
                    'name',
                    'address',
                    'city',
                    'neighborhood',
                    'number_address',
                    'state',
                    'zip',
                    'referral_source',
                    'segment_id',
                ];

                foreach ($array as $field) {
                    if (empty($user->business->{$field})) {
                        return redirect()->route('complete-profile');
                    }
                }
            }
        }

        return $next($request);
    }
}
