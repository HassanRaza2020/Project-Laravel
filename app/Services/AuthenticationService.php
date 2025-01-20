<?php

namespace App\Services;

use App\Repositories\AuthenticationRepository;

class AuthenticationService{

    protected $authenticationRepo;

    public function __construct(AuthenticationRepository $authenticationRepo)
    {
        $this->authenticationRepo = $authenticationRepo;
    }

    public function create($data,$otp)
    {
        return $this->authenticationRepo->create($data,$otp); //calling the createQuestion method
    }

}
