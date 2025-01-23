<?php

namespace App\Services;
use App\Repositories\VerificationRepository;
use App\Jobs\MailVerification;
use App\Models\Verifications;
use Carbon\Carbon;

class VerificationService
{

  protected $verificationRepo;

   public function __construct(VerificationRepository $verificationRepo){
    $this->verificationRepo = $verificationRepo;
 }

 public function create($data){
    return $this->verificationRepo->create($data); //create uder after verification otp is comfirmed
 }

 public function resent($data){
   $userInfo = $data["userinfo"];                                                                   //fetehing the user information  
   $otp      = rand(100000, 999999);                                                              //otp generator using rand function
   $duration = 20;                                                                                //20 second timer
   $endTime  = time() + $duration;                                                                // Calculate OTP expiration time
   $this->verificationRepo->resent($data['userinfo']['email'], $otp);                         // Create the OTP using the service
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


}