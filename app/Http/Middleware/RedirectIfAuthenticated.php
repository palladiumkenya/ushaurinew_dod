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
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->access_level == 'Facility') {
                    return redirect('/Reports/facility_home');
                } else if ($request->access_level == 'Partner') {
                    return redirect('/Reports/dashboard');
                } else if ($request->access_level == 'Admin') {
                    return redirect('/Reports/dashboard');
                }else {
                    return redirect('/Reports/dashboard');
                }
            }
        }

        return $next($request);
    }
}
