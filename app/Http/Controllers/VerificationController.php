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

        $arrayOtp             = $this->verificationService->OtpVerification($request); //calling the otp function
        [$userinfo, $endTime] = [$arrayOtp["userinfo"], $arrayOtp["endTime"]];         //accessing and storing the variables

        return view('auth.verification', compact('userinfo', 'endTime')); // Pass data to the view
    }

    public function verificationOtp(OtpRequest $request)
    {
        $otp         = $request->otpverification;
        $selectedOtp = $this->verificationService->searchOtp($request);

        if ($selectedOtp->otp === $otp) {
            $this->userService->create($request);
            session()->flash($request->userinfo['username']); //entering the username in the session

            // Create a new sign-up instance with dynamic data $2y$12$POLIqRaNnlNz76mREF95ce2ArdhdcZuSlM2Z9iOiJIThEN0VpiJ3e

            return to_route('login')->with('status', 'Your Credentials Successfully Created, Please Login'); //redirecting to login when credentials are being set
        } else if ($selectedOtp === "invalid") {
            return redirect()->back()->with(['errors' => 'otp is invalid here', 'userinfo' => $request->userinfo]);

        } else if ($selectedOtp === "expired") {
            return redirect()->back()->with(['errors' => 'otp is expired here', 'userinfo' => $request->userinfo]);

        }

    }
    public function resentOtp($userarray)
    {
        return $this->verificationService->resentOtp($userarray); // resent the the OTP using the service

    }

}
