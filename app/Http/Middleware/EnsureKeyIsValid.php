<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Answer;
use App\Models\Question;

class EnsureKeyIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
     if(!$request->session()->has('key')){
      
        return redirect()->route('questions')->with('Access denied: Missing key.');

     } 

      
        return $next($request);
    }
}
