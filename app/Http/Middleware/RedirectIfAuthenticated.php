<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check())  //check that if the user is authenticated or noi

            {
                $searchEngine = config('app.search_engine', 'https://www.google.com'); // Default to Google if not set
                return redirect($searchEngine); //return to search engine
            }
        }

        // Allow the request to proceed if user is not authenticated
        return $next($request);
    }
}
