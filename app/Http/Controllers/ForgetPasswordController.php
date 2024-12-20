<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgetpassword;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class ForgetPasswordController extends Controller

{

    public function forget_password(Request $request){

     $email = $request->input('forget-password');   


   
    
     

     $link = URL::temporarySignedRoute('module.redirected', now()->addMinutes(2));
     //dd($link);

    $name  = User::where('email', $email)->select('username')->first();
    $name=$name->username;


     Mail::to($email)->send(new forgetpassword($name, $link));


    }


       
     
}
