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

class AuthController extends Controller
{
    public function showSignUpForm()


    {   

       // dd((Auth::check()));
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
/*    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'address' => $request->address,
    ]);
  */ 
    //$email = $request->email;

    $user_info =
    [
        'username' => $request->username,
        'email' => $request->email,
        'password' => $request->password,
        'address' => $request->address,
    ];



    $duration = 120;
    $endTime = time() + $duration; 
 
   $opt = rand(100000,999999);
   $opt = strval($opt);
   //dd($opt);
   //dd(Carbon::now()->addMinute(2));

   $verifications = Verifications::create(['email'=>$request->email,'otp'=>$opt,
   'expires_at'=>Carbon::now()->addMinute(2)]);
//dd($verifications);

    
    // Send welcome email
    
 Mail::to($request->email)->send(new MyEmail($request->username, $opt));
                      
    return view('auth.verification', compact('user_info', 'endTime'));

   }


    public function login(Request $request)

    {
    // Validate the login data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

   //dd($request->all());

 // Attempt to authenticate the user
    $credentials = $request->only('email', 'password');
  //dd($credentials);

 if (Auth::attempt($credentials)) {
   
  $request->session()->put('username', Auth::user()->username);
  $request->filled('remember');
  //  return to_route('questions');
          $user = User::where('email',request('email'))->first();
        
         // dd(Hash::check(request('password'), $user->getAuthPassword()));
          if(Hash::check(request('password'), $user->getAuthPassword()))
          {
            $token = $user->createToken('web-session')->plainTextToken;
               
            // Redirect to questions route
           return to_route('questions')->with('success', 'Logged in successfully.', ["token"=>$token]);
            //return response()->json(["token"=>$token]);
      
          }


          }

         else
        {
           return back()->withErrors(['email' => 'The provided credentials do not match our records.' ]);
        }


}


}