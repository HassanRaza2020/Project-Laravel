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
use App\Services\VerificationService;

class AuthController extends Controller
{
    protected $verificationService;
    
    public function __construct(VerificationService $verificationService){
       $this->verificationService = $verificationService;         
    }


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
        $otp = rand(100000,999999);
        $userinfo = $this->verificationService->create($request,$otp); 
        $duration = 120;
        $endTime = time() + $duration;

        MailVerification::dispatch($userinfo['username'], $userinfo['email'], $otp);
    
        return view('auth.verification', compact('userinfo', 'endTime'));

    }

    public function logIn(LoginRequest $request)
    {
    
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
        } 
        else 
        {
            return back()->withErrors(['password' => 'Invalid Password has been Entered']);
        }

    }

}
