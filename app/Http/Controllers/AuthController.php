<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\AuthenticationService;

class AuthController extends Controller
{
    protected $authenticationSerivce; //declaring the variable

    public function __construct(AuthenticationService $authenticationSerivce)
    {
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

    public function signupForm(SignupRequest $request)
    {
        $userinfo = $this->authenticationSerivce->create($request);   //sending the create verification request
        return redirect()->route('view-verification-otp', ["userinfo"=>$userinfo]); //redirect the page to specified route with userinfo array
    }

    public function loginForm(LoginRequest $request)
    {
         
       return $this->authenticationSerivce->LoginRequest($request);  
       
    }

}
