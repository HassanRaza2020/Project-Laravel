<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showSignUpForm()
    {
        return view('auth.signup');
    }

     // Show the login form
     public function showLoginForm()
     {
         return view('auth.login');  // Ensure that this view exists in your resources/views/auth/login.blade.php
     }


    public function signUp(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'address' => 'required|string|max:255',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);

     //   return redirect()->route('signup.form')->with('success', 'User registered successfully!');
      
     return redirect()->route('login')->with('success', 'User registered successfully!');    
    
    }

    public function login(Request $request)
    {
        // Validate the login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect to dashboard or home page after successful login
            return redirect()->intended('/questions');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }





}
