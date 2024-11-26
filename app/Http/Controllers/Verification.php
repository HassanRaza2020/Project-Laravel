<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Verifications;
use Illuminate\Support\Facades\Auth;

use App\Models\User;



class Verification extends Controller
{

public function verification_otp(Request $request){

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


  
     }


