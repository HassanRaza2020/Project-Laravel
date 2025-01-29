<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Verifications;
use Carbon\Carbon;

class VerificationRepository
{

    protected $verificationRepo, $user;

    public function __construct(Verifications $verificationRepo, User $user) //intializing the constructor
    {
        $this->verificationRepo = $verificationRepo;
        $this->user             = $user;
    }

    // Insert verification details into the database

    public function searchOtp($data)
    {
        return $this->verificationRepo::where("otp", $data->otpverification)->first(); //search the otp in the database if otp matches
    }

    public function resentOtp($email, $otp)
    {

        $verification = $this->verificationRepo::create([
            'email'      => $email,                        //inserting the email
            'otp'        => $otp,                          //inserting the otp
            'expires_at' => Carbon::now()->addMinute(2)]); //adding the time which expires after 2 minutes
        return $verification;                          //returning the query

    }

}
