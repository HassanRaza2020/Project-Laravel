<?php
namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Services\AuthenticationService;
use App\Services\UserService;
use App\Services\VerificationService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

    protected $verificationService, $authenticationService, $userService;

    public function __construct(VerificationService $verificationService, AuthenticationService $authenticationService, UserService $userService)
    {
        $this->verificationService   = $verificationService;
        $this->authenticationService = $authenticationService;
        $this->userService           = $userService;
    }

    public function viewOtpVerification(Request $request)
    {
        $result = $this->verificationService->OtpVerification($request); //calling the otp function  
        return view('auth.verification', ["endTime"=>$result['endTime'], "userinfo"=>$result['userinfo']]); // Pass data to the view
    }

    public function verificationOtp(OtpRequest $request)
    {
       return $this->verificationService->searchOtp($request);
    }
    public function resentOtp(Request $request)
    {
        return $this->verificationService->resentOtp($request); // resent the the OTP using the service
    }

}
