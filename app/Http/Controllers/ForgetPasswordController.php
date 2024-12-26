<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Jobs\SendMail;
use App\Models\User;
use App\Models\Forget_Password;

class ForgetPasswordController extends Controller

{
    public function forgetPassword(Request $request)
    {

        if($request->has('email'))   //verifying that the email exists in the database
        {
            $user = User::where('email',$request->email)->first();
        }
        
        else
        {
            return back()->withErrors(['email' => 'The provided email does match our records.' ]);   
        }
                                   
        $name = $user->username;  //fetcthing the username form the reques
        $link = URL::temporarySignedRoute('module.redirected', Carbon::now()->addMinutes(2), ['email' => $request->email]); //creating the signature link that will expire in 2 minutes
        Forget_Password::create(["email"=>$request->email]);  //storing the forget email data in the database
        SendMail::dispatch($name, $link, $request->email);   //send the email using the job dispatch 
        return redirect()->back()->with('success', 'Email has been sent successfully');
       }
    
    
    public function confirmPassword(Request $request){

          
        if ( $request->OldPassword === $request->NewPassword) //checking that both passwords matches and confirmed
        {

            if(strlen( $request->OldPassword) < "8" && strlen($request->NewPassword)<"8")  //checking that the passwords are equal or greater than 8 letters
            {
                
                return redirect()->back()->with('error', 'Password should be atleast 8 characters ');
            }
            

            $email = $request->email;
            $user = User::where('email',$email)->first();
            
            if($user) {
            $user->password = Hash::make($request->NewPassword); //password exist in the database, it will update the encrypted password
            $user->save(); //saving the password
            return to_route('login')->with('status', 'Password reset successfully');
            } 
              

        }
        else if( $request->OldPassword!== $request->NewPassword)  //if both passwords does not matches, it will through this message
        {
            
            return redirect()->back()->with('error', 'Passwords does not matches'); 
        }     
    
    }

    }


       
     
