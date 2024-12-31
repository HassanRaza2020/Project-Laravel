<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Mail\MyEmail;
use App\Models\User;
use App\Jobs\MailVerification;


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

            // Validate input
    $request->validate([
        'username' => 'required|string|min:6',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
        'address' => 'required|string|max:255',
    ]);




    $userinfo =['username' => $request->username,'email' => $request->email,'password' => $request->password,'address' => $request->address];



    $duration = 120;
    $endTime = time() + $duration; 
 
    $otp = rand(100000,999999);
    $otp = strval($otp);
  

    $verifications = Verifications::create(['email'=>$request->email,'otp'=>$otp,'expires_at'=>Carbon::now()->addMinute(2)]);
   
   
    MailVerification::dispatch($request->username, $request->email, $otp);
     
    return view('auth.verification', compact('userinfo', 'endTime'));

    }


    public function logIn(Request $request)

    {
    
    $request->validate(['email' => 'required|email','password' => 'required|min:8']);

    $credentials = $request->only('email', 'password');
  
    if (Auth::attempt($credentials)) 
    {
   
          $request->session()->put('username', Auth::user()->username);
          $request->filled('remember');
  
          $user = User::where('email',request('email'))->first();
        
          if(Hash::check(request('password'), $user->getAuthPassword()))
          {
            $token = $user->createToken('web-session')->plainTextToken;
               
           return to_route('questions')->with('success', 'Logged in successfully.', ["token"=>$token]);
      
          }

          }

         else
        {
           return back()->withErrors(['email' => 'The provided credentials do not match our records.' ]);
        }


}


}