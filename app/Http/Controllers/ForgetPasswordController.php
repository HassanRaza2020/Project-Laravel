<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\forgetpassword;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Forget_Password;

class ForgetPasswordController extends Controller

{
    public function forget_password(Request $request)
    {

        if($request->has('email')){
            $user = User::where('email',$request->email)->first();
        }
        
        else{
            return back()->withErrors(['email' => 'The provided email does match our records.' ]);   
        }
        
                             
        $name = $user->username;

        $link = URL::temporarySignedRoute('module.redirected', Carbon::now()->addMinutes(2), ['email' => $request->email]);

        Forget_Password::create(["email"=>$request->email]);
        
        Mail::to($request->email)->send(new forgetpassword($name, $link, $request->email));
          
        return redirect()->back()->with('success', 'Email has been sent successfully');

       }
    
    
    public function confirm_password(Request $request){

          
        if ( $request->OldPassword === $request->NewPassword)
        {

            if(strlen( $request->OldPassword) < "8" && strlen($request->NewPassword)<"8")
            {
                
                return redirect()->back()->with('error', 'Password should be atleast 8 characters ');
            }
            

            $email = $request->email;
            $user = User::where('email',$email)->first();
            
            if($user)
            {
            $user->password = Hash::make($request->NewPassword);
            $user->save();
            return to_route('login')->with('status', 'Password reset successfully');
            } 
              

        }
        else if( $request->OldPassword!== $request->NewPassword)
        {
            
            return redirect()->back()->with('error', 'Passwords does not matches');
        }     
    
    }

    }


       
     
