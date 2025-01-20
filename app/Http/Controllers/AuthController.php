<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Jobs\MailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthenticationService;

class AuthController extends Controller
{
    protected $authenticationSerivce; //declaring the variable
    
    public function __construct(AuthenticationService $authenticationSerivce){
       $this->authenticationSerivce = $authenticationSerivce;         
    }


    public function showSignUpForm()
    {
        return view('auth.signup'); // resources/views/auth/signup.blade.php
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    public function signUp(SignupRequest $request)
    {   
         
        $otp = rand(100000,999999); //gernerating otp using rand
        $userinfo = $this->authenticationSerivce->create($request,$otp); //sending the create verification request
        session()->put(["userinfo"=>$userinfo, "otp"=>$otp]);  //sending the variables userinfo array and otp code
        MailVerification::dispatch($userinfo['username'] ,$userinfo['email'], $otp); //sending the mail function request
        return redirect()->route('view-verification-otp')->with('userinfo',$userinfo); //redirect the page to specified route with userinfo array
    }

    public function logIn(LoginRequest $request)
    {
    
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) //if login credentials matches, the user logs in
        {
            $request->session()->put('username', Auth::user()->username);
            $request->filled('remember'); //token remember me request
            $user = User::where('email', request('email'))->first();

            if (Hash::check(request('password'), $user->getAuthPassword())) 
            {
                $token = $user->createToken('web-session')->plainTextToken; //getting the form validation
                return to_route('questions')->with('success', 'Logged in successfully.', ["token" => $token]);
            }
        } 
        else 
        {
            return back()->withErrors(['password' => 'Invalid Password has been Entered']);  //if password doesnot matches
        }

    }

}
