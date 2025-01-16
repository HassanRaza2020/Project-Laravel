<?php
namespace App\Repositories;
use App\Models\User;
use App\Models\Verifications;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

class AuthenticationRepository {


    protected $verificationRepo, $user;

    public function __construct(Verifications $verificationRepo, User $user) //adding the constructor to add model
    {
        $this->verificationRepo = $verificationRepo; 
        $this->user = $user;
    }


    public function create($data, $otp)  //to create verification   
  {
       //dd($data->all());
        try {
            $userInfo = [
                'username' => $data->username,
                'email' =>    $data->email,
                'password' => $data->password,
                'address' =>  $data->address ];

            
            $this->verificationRepo::create([
                'email' => $userInfo['email'], 
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinute(2), // OTP expiration time
            ]);



        } catch (\Exception $e) {
            // Log the exception message for debugging purposes
            Log::error('Verification creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Please enter the data from the form again.');
        }
        //dd($userInfo);
        return $userInfo;
            
      

    }

       
}