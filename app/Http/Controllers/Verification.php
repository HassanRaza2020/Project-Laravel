<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Verifications;
use Illuminate\Support\Facades\Auth;


class Verification extends Controller
{

public function verification_otp(Request $request){

   $otp = $request->otpverification;
   ($request->email); 
   
   $selected_otp  = Verifications::where('email',$request->email)
   ->where('otp',$otp)
   ->first();
  

    
   if(!$selected_otp){
      return response()->json(['message'=>'Invalid Otp'], 400);
   }

   if (Carbon::now()->greaterThan($selected_otp->expires_at)) {
      return response()->json(['message' => 'OTP has expired'], 400);
  }
   
 else {

   $request->session()->put('username', Auth::user()->username); 
  
   return to_route('questions');

 }

  
     }

}
