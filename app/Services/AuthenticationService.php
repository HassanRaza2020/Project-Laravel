<?php

namespace App\Services;

use App\Repositories\AuthenticationRepository;
use App\Jobs\MailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthenticationService {

    protected $authenticationRepo;

    public function __construct(AuthenticationRepository $authenticationRepo)
    {
        $this->authenticationRepo = $authenticationRepo;
    }

    public function create($data){
   
        $otp = rand(000000,999999); //generating the otp using rand function   
        try {
            $userInfo = [                   //creating the userinfo array
                'username' => $data->username,
                'email' =>    $data->email,
                'password' => $data->password,
                'address' =>  $data->address 
            ];
           
            $this->authenticationRepo->create($otp,$data); 
            session()->put(["userinfo" => $userInfo, "otp" => $otp]);                       //sending the variables userinfo array and otp code
            MailVerification::dispatch($userInfo['username'], $userInfo['email'], $otp);    //sending the mail function request



        } catch (\Exception $e) {
            // Log the exception message for debugging purposes

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Please enter the data from the form again.');
        }
        return $userInfo;
    }

    public function createLogin($data)

{
        $credentials = $data->only('email', 'password');

        if (Auth::attempt($credentials)) //if login credentials matches, the user logs in
        {
            $data->session()->put('username', Auth::user()->username); //storing the username in the session
            $data->filled('remember'); //token remember me request
            $user = $data->email; //fetch the email from the  request

            if (Hash::check(request('password'), $user->getAuthPassword())) {
                $token = $user->createToken('web-session')->plainTextToken; //getting the form validation
                return to_route('questions')->with('success', 'Logged in successfully.', ["token" => $token]);
            }
        } else {
            return back()->withErrors(['password' => 'Invalid Password has been Entered']); //if password doesnot matches
        } 





    
}


}