<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Services\ForgetPasswordService;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected $forgetPasswordService;

    public function __construct(ForgetPasswordService $forgetPasswordService)
    {
        $this->forgetPasswordService = $forgetPasswordService; 
    }

    // Handle forget password request
    public function forgetPassword(ForgetPasswordRequest $request)
    { 
  
        $response = $this->forgetPasswordService->processForgetPassword($request->email); //calling the forgetPassword function for verifying email 

        if ($response['success']) {
            $this->forgetPasswordService->create($request->email); // Execute the service logic
            return redirect()->back()->with('success', $response['message']); // Redirect after the service call                
        }
        else
        {
            return redirect()->back()->with('error', 'email not being sent'); 
        }
     
    }

    // Handle password confirmation
    public function confirmPassword(Request $request)
    {
        $response = $this->forgetPasswordService->processConfirmPassword(
            $request->email,
            $request->OldPassword,
            $request->NewPassword
        );

        if ($response['success']) {
            return redirect()->route('login')->with('status', $response['message']); //sending the success message after new password created
        }

        return redirect()->back()->with('error', $response['message']);
      }

      public function redirectToPassword($email)
      {
          return view('auth.confirm-password', compact('email'));
      }


}
