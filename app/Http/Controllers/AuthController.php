<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Jobs\MailVerification;
use App\Models\User;
use App\Models\Verifications;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignUpForm()
    {
        return view('auth.signup');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure that this view exists in your resources/views/auth/login.blade.php
    }

    public function signUp(SignupRequest $request)
    {
      

        $userinfo = ['username' => $request->username, 'email' => $request->email, 'password' => $request->password, 'address' => $request->address];

        $duration = 120;
        $endTime = time() + $duration;

        $otp = rand(100000, 999999);
        $otp = strval($otp);

        $data = [
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinute(2),
        ];

        $verifications = Verifications::create($data); //inserting the data in the verifications table.
        //  Also opt expires at the given time in the database

        MailVerification::dispatch($request->username, $request->email, $otp); //Using Job Quene for sending the mail

        return view('auth.verification', compact('userinfo', 'endTime'));

    }

    public function logIn(LoginRequest $request)
    {
        
        // if ($request->fails()) {  //if form validation fails here 
        //     return redirect()->
        //     back()->withErrors($request)
        //     ->withInput();
        // }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) //if login credentials matches, the user logs in
        {
            $request->session()->put('username', Auth::user()->username);
            $request->filled('remember'); //token remember me request

            $user = User::where('email', request('email'))->first();

            if (Hash::check(request('password'), $user->getAuthPassword())) {
                $token = $user->createToken('web-session')->plainTextToken; //getting the form validation

                return to_route('questions')->with('success', 'Logged in successfully.', ["token" => $token]);

            }

        } else {
            return back()->withErrors(['password' => 'Invalid Password has been Entered']);
        }

    }

}
