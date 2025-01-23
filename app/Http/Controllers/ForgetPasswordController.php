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
        $this->forgetPasswordService = $forgetPasswordService; //creating a constructor
    }

    // Handle forget password request
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $response = $this->forgetPasswordService->processForgetPassword($request->email); 

        if ($response['success']) {
            return redirect()->back()->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
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
