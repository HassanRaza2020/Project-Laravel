<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Forget_Password;

class ForgetPasswordRepository
{
    // Find a user by email
    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    // Create a forget password record
    public function createForgetPassword($email)
    {
        return Forget_Password::create(['email' => $email]);
    }

    // Update user password
    public function updatePassword($email, $newPassword)
    {
        $user = $this->findUserByEmail($email);

        if ($user) {
            $user->password = $newPassword;
            $user->save();
            return true;
        }

        return false;
    }
}
