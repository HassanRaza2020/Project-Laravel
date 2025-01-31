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

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        return $this->forgetPasswordService->processForgetPassword($request->email); // forget password module route & email dispatching
    }
    
    public function confirmPassword(Request $request)
    {
        return $this->forgetPasswordService->processConfirmPassword($request->email, $request->OldPassword, $request->NewPassword);// password confirmation method
    }

    public function redirectToResetPassword($email)
    {
        return view('auth.confirm-password', compact('email'));
    }
}
