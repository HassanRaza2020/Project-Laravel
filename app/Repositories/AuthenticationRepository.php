<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Verifications;
use Carbon\Carbon;

class AuthenticationRepository
{

    protected $verificationRepo, $user;

    public function __construct(Verifications $verificationRepo, User $user) //adding the constructor to add model
    {
        $this->verificationRepo = $verificationRepo;
        $this->user             = $user;
    }

    public function create($data, $otp) //to create verification
    {
        
        
        $create = $this->verificationRepo::create([
            'email'      => $data['email'],                        // inserting the email
            'otp'        => $otp,                                            // inserting the otp
            'expires_at' => Carbon::now()->addMinute(2)->toDateTimeString(), // formatted expiration time
        ]);

        return $create; //creating the verification otp

    }

}
