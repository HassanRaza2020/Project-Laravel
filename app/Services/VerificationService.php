<?php

namespace App\Services;
use App\Repositories\VerificationRepository; 

class VerificationService{

protected $verificationRepo;   

public function __construct(VerificationRepository $verificationRepo)
{
    $this->verificationRepo = $verificationRepo;
}

public function create($data, $otp){
    return $this->verificationRepo->create($data,$otp);  //calling the createQuestion method
}





}
