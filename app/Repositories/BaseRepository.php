<?php

namespace App\Repositories;

use App\Jobs\MailVerification;
use App\Models\User;
use App\Models\Verifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BaseRepository
{
    protected $verificationRepo, $mailVerification, $user;

    public function __construct(Verifications $verificationRepo, MailVerification $mailVerification, User $user) //adding the constructor to add model
    {
        $this->verificationRepo = $verificationRepo;
        $this->mailVerification = $mailVerification;
        $this->user = $user;

    }
    public function create($data, $otp)  //to create verification
    {
        try {
            $userInfo =
                [
                'username' => $data->username,
                'email' => $data->email,
                'password' => $data->password,
                'address' => $data->address,
            ];
            // Insert verification details into the database
            $this->verificationRepo::create([
                'email' => $userInfo['email'], // The email should not be null
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinute(2), // OTP expiration time
            ]);

        } catch (\Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Verification creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Please enter the data from the form again.');
        }

        return $userInfo;

    }

}
