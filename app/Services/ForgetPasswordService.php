<?php

namespace App\Services;

use App\Repositories\ForgetPasswordRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Jobs\ForgetMail;

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

        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }

        $name = $user->username;

        // Create a signed link valid for 2 minutes
        $link = URL::temporarySignedRoute('module.redirected', Carbon::now()->addMinutes(2), ['email' => $email]);

        // Store forget password record
        $this->forgetPasswordRepository->createForgetPassword($email);

        // Dispatch the forget password email
        ForgetMail::dispatch($name, $link, $email);

        return ['success' => true, 'message' => 'Email has been sent successfully'];
    }

    // Handle password confirmation and update
    public function processConfirmPassword($email, $oldPassword, $newPassword)
    {
        if ($oldPassword !== $newPassword) {
            return ['success' => false, 'message' => 'Passwords do not match'];
        }

        if (strlen($newPassword) < 8) {
            return ['success' => false, 'message' => 'Password should be at least 8 characters'];
        }

        // Update the user's password
        $updated = $this->forgetPasswordRepository->updatePassword($email, Hash::make($newPassword));

        if ($updated) {
            return ['success' => true, 'message' => 'Password reset successfully'];
        }

        return ['success' => false, 'message' => 'Failed to reset password'];
    }
}
