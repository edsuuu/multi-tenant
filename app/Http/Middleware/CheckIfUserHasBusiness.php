<?php

namespace App\Http\Middleware;

use App\Models\Business;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserHasBusiness
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if($user->role === 'admin') {
                return $next($request);
            }

            $existingBusiness = Business::where('user_id', $user->id)->first();

            if ($existingBusiness) {
                $validNullFields = ['documents', 'photo'];
                $invalidFields = [];

                foreach ($existingBusiness->toArray() as $key => $value) {
                    if (is_null($value) && !in_array($key, $validNullFields)) {
                        $invalidFields[] = $key;
                    }
                }

                if (count($invalidFields) > 0 && !Route::is('complete-profile')) {
                    return redirect()->route('complete-profile');
                }
            }
        }

        return $next($request);
    }
}
