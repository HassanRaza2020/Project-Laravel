<?php

namespace App\Otp;


use App\Models\User;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserRegistrationOtp implements Otp
{
    /**
     * Constructs Otp class
     */
    public function __construct()
    {
     
        //
    }

    /**
     * Processes the Otp
     *
     * @return mixed
     */
    public function process()
    {
       User::unguard(function(){
   
      return User::create([
         'email_verified_at'=>now(),
      ]);

   event(new Registered($user));   

   Auth::login($user);

              


        });
    }
}
