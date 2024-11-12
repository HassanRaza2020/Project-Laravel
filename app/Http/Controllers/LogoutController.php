<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class LogoutController extends Controller
{
    public function logout(Request $request)
    {
     
        // Log the user out
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the CSRF token to prevent session fixation
    $request->session()->regenerateToken();

    // Redirect to login page with success message
    return redirect()->route('login')->with('success', 'You have been logged out successfully.');

   }
     
}
