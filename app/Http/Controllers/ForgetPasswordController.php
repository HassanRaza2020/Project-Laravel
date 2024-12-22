<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\forgetpassword;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class ForgetPasswordController extends Controller

{
    public function forget_password(Request $request)
    {
        $email = $request->input('forget-password');
        $name = User::where('email', $email)->select('username')->first()->username;
         //dd($email);
        // Pass the email as a parameter to the route
        $link = URL::temporarySignedRoute('module.redirected', now()->addSeconds(5), $email);
         //dd($link);
        // Send the email with the link
        Mail::to($email)->send(new forgetpassword($name, $link, $email));
    }
    
    public function confirm_password(Request $request){

        $request->validate([
            'password-1' => 'required|min:8',
            'password-2' => 'required|min:8',
        ]);
    

          
        if ($request->input('password-1') === $request->input('password-2'))
        {
            $email = $request->email;
            $user = User::where('email',$email)->first();
            
            if($user)
            {
            $user->password = Hash::make($request->input('password-2'));
            $user->save();
            return to_route('login')->with('status', 'Password reset successfully');
            } 
              

        }
        else
        {
            return redirect()->back()->with('failed', 'Passwords does not matches');
        }
        
    
    }

    }


       
     
