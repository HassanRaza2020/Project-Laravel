<?php

namespace App\Services;

use App\Repositories\VerificationRepository;
use App\Jobs\MailVerification;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class VerificationService
{

  protected $verificationRepo,$userRepository;

   public function __construct(VerificationRepository $verificationRepo, UserRepository $userRepository){
    $this->verificationRepo = $verificationRepo;
    $this->userRepository = $userRepository;
 }

 public function create($data){
    
    return $this->userRepository->create($data); //create user after verification otp is comfirmed
 }

 public function resentOtp($data){
   $userInfo = $data["userinfo"];                                                                   //fetehing the user information  
   $otp      = rand(100000, 999999);                                                              //otp generator using rand function
   $duration = 20;                                                                                //20 second timer
   $endTime  = time() + $duration;                                                                // Calculate OTP expiration time
   $this->verificationRepo->resentOtp($data['userinfo']['email'], $otp);                         // Create the OTP using the service
   MailVerification::dispatch($data['userinfo']['username'], $data['userinfo']['email'], $otp); //sending the mail

   return redirect()->back()->with(['userinfo' =>$userInfo , 'endTime' => $endTime]); // Redirect back to the same page with flash data
    }

 public function searchOtp($data){
   
   $searchOtp = $this->verificationRepo->searchOtp($data);  //searching the otp through the id
   if ($searchOtp)   //if query satisfies, it wll return the results 
       {
            return $searchOtp;
       }  
       else if ($searchOtp===null)  //if query is null, it wll return the results  
       {
            return "invalid";   
       }       
        else if (Carbon::now()->greaterThan($searchOtp->expires_at)) //if otp gets expired
      {
            return "expired";

      } 
}


   public function OtpVerification($userInfoResent = null)
    {
        $duration = 20;                 // Duration in seconds
        $endTime  = time() + $duration; // Calculate OTP expiration time

        // Use $userInfoResent if it's not null, otherwise retrieve from session
        if ($userInfoResent !== null) 
        {
            $userinfo = $userInfoResent;
            return ["endTime"=>$endTime, "userinfo"=> $userinfo];
        } 
        else 
        {   
            $userinfo = session()->only(['username', 'email','password','address']); //retreiving the values       
            session()->forget(['username', 'email','password','address']);
            return ["endTime"=>$endTime, "userinfo"=> $userinfo];
 
        }
      }




}