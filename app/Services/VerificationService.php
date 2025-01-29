<?php
namespace App\Services;

use App\Jobs\MailVerification;
use App\Repositories\UserRepository;
use App\Repositories\VerificationRepository;
use Carbon\Carbon;

class VerificationService
{

    protected $verificationRepo, $userRepository;

    public function __construct(VerificationRepository $verificationRepo, UserRepository $userRepository)
    {
        $this->verificationRepo = $verificationRepo;
        $this->userRepository   = $userRepository;
    }

    public function create($data)
    {

        return $this->userRepository->create($data); //create user after verification otp is comfirmed
    }

    public function resentOtp($userarray)
    {
        $userInfo = json_decode(base64_decode($userarray), true);                    // Decode the array
        $otp      = rand(100000, 999999);                                            //otp generator using rand function
        $duration = 20;                                                              // otp durcation timer
        $endTime  = time() + $duration;                                              // Calculate OTP expiration time
        $this->verificationRepo->resentOtp($userInfo['email'], $otp);                // Create the OTP using the service
        MailVerification::dispatch($userInfo['username'], $userInfo['email'], $otp); //sending the mail using the jobs

        return redirect()->back()->with(['userinfo' => $userInfo, 'endTime' => $endTime]); // Redirect back to the same page with flash data
    }

    public function searchOtp($data)
    {

        $searchOtp = $this->verificationRepo->searchOtp($data); //searching the otp through the id
        if ($searchOtp)                                         //if query satisfies, it wll return the results
        {
            return $searchOtp;
        } else if ($searchOtp === null) //if query is null, it wll return the results
        {
            return "invalid";
        } else if (Carbon::now()->greaterThan($searchOtp->expires_at)) //if otp gets expired
        {
            return "expired";

        }
    }

    public function OtpVerification($data)
    {
        $duration = 20;                                                // Duration in seconds
        $endTime  = time() + $duration;                                // Calculate OTP expiration time
        return ["endTime" => $endTime, "userinfo" => $data->userinfo]; //returning the values
    }

}
