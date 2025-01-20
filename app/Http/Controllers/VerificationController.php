<?php

namespace App\Http\Controllers;
use App\Http\Requests\OtpRequest;
use App\Mail\SignUpConfirmed;
use App\Services\VerificationService;
use App\Services\AuthenticationService;
use App\Notifications\SignUp;
use Illuminate\Support\Carbon;
use App\Jobs\MailVerification;
use App\Http\Requests\ResentOtpRequest;
use App\Services\UserService;
use App\Http\Requests\SignupRequest;
use GuzzleHttp\Psr7\Request;

class VerificationController extends Controller {
 
   protected $verificationService,$authenticationService, $userService;
   
   public function __construct(VerificationService $verificationService, AuthenticationService $authenticationService, UserService $userService)
   {
       $this->verificationService = $verificationService;
       $this->authenticationService = $authenticationService;
       $this->userService = $userService;
   }

   public function viewOtpVerification($userInfoResent = null)
{
    $otp = rand(100000, 999999);      
    $duration = 20; // Duration in seconds
    $endTime = time() + $duration; // Calculate OTP expiration time

    
    // Use $userInfoResent if it's not null, otherwise retrieve from session
    if ($userInfoResent !== null) {
        $userinfo = $userInfoResent;       
    } else { 
        $userinfo = session()->get('userinfo');
    }
 
    // Pass data to the view
    return view('auth.verification', compact('userinfo', 'endTime'));
}


    public function verificationOtp(OtpRequest $request)

    {
            $otp=$request->otpverification; 
            $selectedOtp=$this->verificationService->searchOtp($request);
           
             
            if ($selectedOtp->otp===$otp){
            $this->userService->create($request);                
            session()->flash('userinfo', $request->userinfo['username']);

              //session for username
             // auth()->login($user);
             //Session::forget(['otp','user_id']);
            // Create a new sign-up instance with dynamic data
            new SignUp($request->userinfo['username'], $request->userinfo['email']);

           // Send the confirmation email
            //Mail::to($email)->send(new SignUpConfirmed($request->userinfo['username']));
            return to_route('login')->with('status', 'Your Credentials Successfully Created, Please Login'); //redirecting to login when credentials are being set
            }

            else if($selectedOtp==="invalid") {
                return redirect()->back()->with(['errors'=>'otp is invalid here', 'userinfo'=>$request->userinfo]);

            }

            else if ($selectedOtp==="expired") {
                return redirect()->back()->with(['errors'=>'otp is expired here','userinfo'=>$request->userinfo]);

            }



    }
    public function resentOtp(ResentOtpRequest $request)
    {
        $userinFo=$request->userinfo;
        $otp = rand(100000, 999999); //otp generator
        $duration = 20; //20 second timer
        $endTime = time() + $duration; // Calculate OTP expiration time   
        // Create the OTP using the service
        //$userinfo = session('userinfo');
        
        $this->verificationService->resent($request->userinfo['email'], $otp);
        MailVerification::dispatch($request->userinfo['username'],$request->userinfo['email'],$otp);
        
        
        // Redirect back to the same page with flash data
        return redirect()->back()->with(['userinfo'=> $userinFo, 'endTime'=>$endTime]);
    }
    
}
