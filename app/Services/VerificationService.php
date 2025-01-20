<?php

namespace App\Services;
use App\Repositories\VerificationRepository;
use App\Models\Verifications;


class VerificationService
{

  protected $verificationRepo;

   public function __construct(VerificationRepository $verificationRepo){
    $this->verificationRepo = $verificationRepo;
 }

 public function create($request){
    return $this->verificationRepo->create($request);
 }

 public function resent($email, $otp){
    return $this->verificationRepo->resent($email, $otp);
 }

 public function searchOtp($data){
   return $this->verificationRepo->searchOtp($data);
}








}