<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Verifications;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;

use App\Models\User;



class Verification extends Controller
{

public function verificationOtp(Request $request){

   $otp = $request->otpverification;
   $email = $request->user_info['email'];

 
   
   $selected_otp  = Verifications::where('email',$email)
   ->where('otp',$otp)
   ->first();

   

  //dd($selected_otp,$otp);
    
   if(!$selected_otp){
      return response()->json(['message'=>'Invalid Otp'], 400);
   }

   else if (Carbon::now()->greaterThan($selected_otp->expires_at)) {
      return response()->json(['message' => 'OTP has expired'], 400);
  }

   
 else {


   
 $user= User::create([
      'username' => $request->user_info['username'],
      'email' => $request->user_info['email'],
      'password' => Hash::make($request->user_info['password']),
      'address' => $request->user_info['address'],
  ]);

  session()->flash('user_info', $request->user_info['username']);


  //$request->session()-> put('username', Auth::user()->user_info['username']);

  auth()->login($user);
  //Session::forget(['otp','user_id']);
  session()->flash('user_info',$user->username);




  return to_route('login')->with('status', 'Your Credentials Successfully Created, Please login');


} 




 }


  public function resentOtp(Request $request){
   
  
   $duration = 5;
   $endTime = time() + $duration; 


 
  $opt = rand(100000,999999);
  $opt = strval($opt);
  //dd($opt);
  //dd(Carbon::now()->addMinute(2));

  Verifications::create(['email'=>$request->user_info['email'],'otp'=>$opt,
  'expires_at'=>Carbon::now()->addMinute(2)]);



  Mail::to($request->user_info['email'])->send(new MyEmail($request->user_info['username'], $opt));


return response()->noContent()->with('endtime');
    //return back();

   // Send welcome email
   
 

  }



  
     }


