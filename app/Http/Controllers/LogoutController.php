<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logOut(Request $request)
    {
        // Log the entire session to see its contents
        Log::info('Current session data:', $request->session()->all());

        // Check if the user is logged in
        if (Auth::check()) 
        {
            // Log the user out
            Log::info('User is logging out.');
            Auth::logout();
        }

        // Invalidate the session if it exists
        if ($request->session()->has('token')) 
        {
            // Optionally, clear any token or session data
            $request->session()->forget('token');
        }

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
