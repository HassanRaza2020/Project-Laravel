<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class VerifySignedRouteExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // Apply validation only for specific signed routes
         if (!$request->routeIs('module.redirected')) {
            return $next($request); // Skip for other routes
        }
        
        if (!URL::hasValidSignature($request)) {
            return response()->view('errors.link-expired', [], 403); // Custom "Link Expired" view
        }

        return $next($request);
    }
}
