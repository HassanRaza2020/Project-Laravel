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
 //  dd($request->all());

 // dd($otp,$email);

   
   $selected_otp  = Verifications::where('email',$email)
   ->where('otp',$otp)
   ->first();
  // dd($selected_otp); 

    
   if(!$selected_otp){
      return response()->json(['message'=>'Invalid Otp'], 400);
   }

   if (Carbon::now()->greaterThan($selected_otp->expires_at)) {
      return response()->json(['message' => 'OTP has expired'], 400);
  }
   
 else {

   User::create([
      'username' => $request->user_info['username'],
      'email' => $request->user_info['email'],
      'password' => Hash::make($request->user_info['password']),
      'address' => $request->user_info['address'],
  ]);
    
  $request->session()->put('username', Auth::user()->user_info['username']);



     return to_route('questions');


} 

{
   return redirect()->route('email_verification')->withErrors(['message' => 'User not authenticated.']);
}

  

 }

  
     }


