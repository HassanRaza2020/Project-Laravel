<?php


namespace App\Repositories;

use App\Models\ForgetPassword;
use App\Models\User;

class ForgetPasswordRepository
{

  protected $forgetPasswordRepo, $userRepo;

  public function __construct(User $userRepo, ForgetPassword $forgetPasswordRepo)
  {
    $this->forgetPasswordRepo = $forgetPasswordRepo;
    $this->userRepo = $userRepo;
  }
   
    // Find a user by email
    public function findUserByEmail($email)
    {
        return $this->userRepo::where('email', $email)->first();
    }

    // Create a forget password record
    public function createForgetPassword($email)
    {
        return $this->forgetPasswordRepo::create(['email' => $email]);
    }

    // Update user password
    public function updatePassword($email, $newPassword)
    {
        $user = $this->findUserByEmail($email);  //email 

        if ($user) {
            $user->password = $newPassword;
            $user->save();
            return true;
        }

        return false;
    }
}
