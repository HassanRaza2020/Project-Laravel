<?php
namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Http\Requests\ResentOtpRequest;
use App\Services\AuthenticationService;
use App\Services\UserService;
use App\Services\VerificationService;
use Illuminate\Support\Facades\Auth;
class VerificationController extends Controller
{

    protected $verificationService, $authenticationService, $userService;

    public function __construct(VerificationService $verificationService, AuthenticationService $authenticationService, UserService $userService)
    {
        $this->verificationService   = $verificationService;
        $this->authenticationService = $authenticationService;
        $this->userService           = $userService;
    }

    public function viewOtpVerification($userInfoResent = null)
    {
        $otp = rand(100000, 999999);
        $duration = 20;                 // Duration in seconds
        $endTime  = time() + $duration; // Calculate OTP expiration time

        // Use $userInfoResent if it's not null, otherwise retrieve from session
        if ($userInfoResent !== null) 
        {
            $userinfo = $userInfoResent;
        } 
        else 
        {   
            $userinfo = session()->only(['username', 'email','password','address']); //retreiving the values       
            session()->forget(['username', 'email','password','address']);
 
        }
        
        // Pass data to the view
        return view('auth.verification', compact('userinfo', 'endTime'));
    }

    public function verificationOtp(OtpRequest $request)
    {
        $otp = $request->otpverification;
        $selectedOtp = $this->verificationService->searchOtp($request);

        if ($selectedOtp->otp === $otp) {
            $this->userService->create($request);
            session()->flash($request->userinfo['username']);

            // Create a new sign-up instance with dynamic data
                                                                                                             
            return to_route('login')->with('status', 'Your Credentials Successfully Created, Please Login'); //redirecting to login when credentials are being set
        }   else if ($selectedOtp === "invalid") {
            return redirect()->back()->with(['errors' => 'otp is invalid here', 'userinfo' => $request->userinfo]);

        } else if ($selectedOtp === "expired") {
            return redirect()->back()->with(['errors' => 'otp is expired here', 'userinfo' => $request->userinfo]);

        }

    }
    public function resentOtp(ResentOtpRequest $request)
    {
            return $this->verificationService->resent($request->all());                         // Create the OTP using the service
        
    }

}
