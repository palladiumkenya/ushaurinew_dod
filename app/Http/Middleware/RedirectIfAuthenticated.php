<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

            if (Auth::guard($guard)->check()) {
                if(Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Partner' || Auth::user()->access_level == 'Donor')
                {
                    return redirect('/Reports/dashboard');
                }
                if(Auth::user()->access_level == 'Facility')
                {
                    return redirect('/Reports/facility_home');
                }
            }
        return $next($request);
    }
}
