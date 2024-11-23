<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Verifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;


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

     public function Opt_View(){
        return view('auth.verification');
      }



    public function signUp(Request $request)
    {

            // Validate input
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
        'address' => 'required|string|max:255',
    ]);

    // Create the user
    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'address' => $request->address,
    ]);




  $opt = rand(100000,999999);
  //$time=time();


  $verf= Verifications::created(['email'=>$request->email,'opt'=>$opt,]);
        

    // Send welcome email
//    Mail::to($request->email)->send(new MyEmail($request->username));

  return response()->json($verf);      

   // return redirect()->route('email_verification')->with('Email has been sent');

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
        // Store the username in session after successful login
        $request->session()->put('username', Auth::user()->username);
        
        // Redirect to dashboard or home page after successful login
        return redirect()->intended('/questions');
    }

    // If login fails, redirect back with an error message
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}





}