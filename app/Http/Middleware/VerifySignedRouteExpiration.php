<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class VerifySignedRouteExpiration
{
public function handle(Request $request, Closure $next): Response

    {
        
        // Check if the request has a valid route
        $route = $request->route();
           
        // If there is no route or the route is unnamed, skip the validation
        if (!$route || !$route->getName()) {
            return $next($request);
        }

        // Check only the 'module.redirected' route
        if ($route->getName() !== 'module.redirected') {
            return $next($request);
        }

        // Validate the signature of the URL
        if (!URL::hasValidSignature($request)) {
            return response()->view('errors.link-expired', [], 403); // Custom "Link Expired" view
        }

        return $next($request);
    }
}
