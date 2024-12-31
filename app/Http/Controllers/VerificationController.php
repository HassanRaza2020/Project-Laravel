<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Verifications;
use App\Models\User;
use App\Jobs\MailVerification;
use App\Notifications\SignUp;
use App\Mail\SignUpConfirmed;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{

public function verificationOtp(Request $request){

   $otp = $request->otpverification;
   $email = $request->userinfo['email'];  
   $selectedOtp  = Verifications::where('email',$email)->where('otp',$otp)->first();

   

  //dd($selected_otp,$otp);
    
   if(!$selectedOtp){
      return response()->json(['message'=>'Invalid Otp'], 400);
   }

   else if (Carbon::now()->greaterThan($selectedOtp->expires_at)) {
      return response()->json(['message' => 'OTP has expired'], 400);
  }
   
 else {
  
      $user= User::create([
      'username' => $request->userinfo['username'],
      'email' => $request->userinfo['email'],
      'password' => Hash::make($request->userinfo['password']),
      'address' => $request->userinfo['address'],


  ]);

  session()->flash('userinfo', $request->userinfo['username']);
  
//session for username


  auth()->login($user);
  //Session::forget(['otp','user_id']);
  session()->flash('userinfo',$user->username);

  new SignUp($request->userinfo['username'], "shiekhhassan1234draq@gmail.com");
  Mail::to($request->userinfo['email'])->send(new SignUpConfirmed($request->userinfo['username']));

  return to_route('login')->with('status', 'Your Credentials Successfully Created, Please login'); //redirecting to login when credentials are being set


} 




 }


  public function resentOtp(Request $request){
   
  
   $duration = 5; 
   $endTime = time() + $duration; //resetting the duration time when the otp expires

  $otp = rand(100000,999999); 
  $otp = strval($otp);
 
  Verifications::create(['email'=>$request->userinfo['email'],'otp'=>$otp,
  'expires_at'=>Carbon::now()->addMinute(2)]);  //inserting the data to database

 
   MailVerification::dispatch($request->userinfo['username'],$request->userinfo['email'],$otp); //sending the email using job dispatch
  
   return response()->noContent()->with('endtime'); //return to page by sending the endtime to view
   
 

  }



  
     }


