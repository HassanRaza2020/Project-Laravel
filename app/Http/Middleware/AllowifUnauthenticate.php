<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;



class AllowifUnauthenticate
{
 /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect authenticated user to home
                return redirect(RouteServiceProvider::HOME);
            }

            if (!Auth::guard($guard)->check()) {
                // Redirect authenticated user to home
                //return redirect(RouteServiceProvider::HOME);
            }

        }

        // Proceed with the request if not authenticated
        return $next($request);
    }
}