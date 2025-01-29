<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class PreventBackButtonMiddleware 
{


    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        Log::info("prevent back middleware executed"); 
        $response = $next($request);
    
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, private')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }
    
}
