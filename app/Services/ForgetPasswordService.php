<?php
namespace App\Services;

use App\Jobs\ForgetMail;
use App\Repositories\ForgetPasswordRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ForgetPasswordService
{
    protected $forgetPasswordRepository;

    public function __construct(ForgetPasswordRepository $forgetPasswordRepository)
    {
        $this->forgetPasswordRepository = $forgetPasswordRepository;
    }

  
 
    // Handle forget password process
    public function processForgetPassword($email)
    {

        $user = $this->forgetPasswordRepository->findUserByEmail($email);
        $name = $user->username;// Create a signed link valid for 2 minutes
        
        try
        {
        $link = URL::temporarySignedRoute('forgetpassword-link.redirected', Carbon::now()->addMinutes(2), ['email' => $email]); //creating a link through temporary sign route
        ForgetMail::dispatch($name, $link, $email);   // Dispatch the forget password email
        $this->forgetPasswordRepository->create($email); // Store forget password record
                                     // Dispatch the forget password email
        return ['success' => true, 'message' => 'Email has been sent successfully'];
        }

        catch(\Exception $e){
            return response()->json(['message' => 'Email sending failed'], 500);
        }

    }

    // Handle password confirmation and update
    public function processConfirmPassword($email, $oldPassword, $newPassword)
    {
        if ($oldPassword !== $newPassword) {
            return ['success' => false, 'message' => 'Passwords do not match']; //passwords does not matches
        }

        if (strlen($newPassword) < 8) {
            return ['success' => false, 'message' => 'Password should be at least 8 characters']; //passwords length does not matches
        }

                                                                                                      // Update the user's password
        $updated = $this->forgetPasswordRepository->updatePassword($email, Hash::make($newPassword)); //creating the new password

        if ($updated) {
            return ['success' => true, 'message' => 'Password reset successfully']; //calling the update password method
        }

        return ['success' => false, 'message' => 'Failed to reset password']; // passoword does not get update due to a failure
    }
}
