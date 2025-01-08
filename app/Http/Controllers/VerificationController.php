<?php

namespace App\Http\Controllers;
use App\Http\Requests\OtpRequest;
use App\Mail\SignUpConfirmed;
use App\Models\User;
use App\Models\Verifications;
use App\Services\VerificationService;
use App\Notifications\SignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\MailVerification;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller
{
 
   protected $verificationService;
   
   public function __construct(VerificationService $verificationService)
   {
       $this->verificationService = $verificationService;
   }


    public function verificationOtp(OtpRequest $request)
    {

    
        $otp = $request->otpverification;
        $email = $request->userinfo['email'];
        $selectedOtp = Verifications::where('email', $email)->where('otp', $otp)->first();
        
        if (!$selectedOtp) 
        {
            return redirect()->back()->with('errors', 'OTP is Invalid, Please enter correct OTP');
        } 
        else if (Carbon::now()->greaterThan($selectedOtp->expires_at)) 
        {
            return redirect()->back()->with('errors', 'OTP has been expired, Please get a new OTP');
                     
        } 
        else 
        {

            $user = User::create([
                'username' => $request->userinfo['username'],
                'email' => $request->userinfo['email'],
                'password' => Hash::make($request->userinfo['password']),
                'address' => $request->userinfo['address']]);

            session()->flash('userinfo', $request->userinfo['username']);

            //session for username

            auth()->login($user);
            //Session::forget(['otp','user_id']);
            session()->flash('userinfo', $user->username);

            // Create a new sign-up instance with dynamic data
            new SignUp($request->userinfo['username'], $request->userinfo['email']);

           // Send the confirmation email
            Mail::to($email)->send(new SignUpConfirmed($request->userinfo['username']));

            

            return to_route('login')->with('status', 'Your Credentials Successfully Created, Please Login'); //redirecting to login when credentials are being set

        }

    }
    public function resentOtp(Request $request)
    {
        $otp = rand(100000, 999999); 
        $duration = 120;
        $endTime = time() + $duration; // Calculate OTP expiration time

        $userinfo = [
            'username' => $request->userinfo['username'],
            'email' =>    $request->userinfo['email'],
            'password' => $request->userinfo['password'],
            'address' =>  $request->userinfo['address']
        ];

    
        // Create the OTP using the service
        $this->verificationService->create($request, $otp);
        MailVerification::dispatch($request->userinfo['username'],$request->userinfo['email'],$otp);

       

    
        // Redirect back to the same page with flash data
        return view('auth.verification',compact('userinfo','endTime'));
    }
    
}
