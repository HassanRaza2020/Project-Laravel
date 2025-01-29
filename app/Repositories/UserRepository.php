<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $userRepository;

    public function __construct(User $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($request)
    {

        $createUser = $this->userRepository::create([ //user creation query
            'username' => $request->userinfo['username'],
            'email'    => $request->userinfo['email'],
            'password' => Hash::make($request->userinfo['password']),
            'address'  => $request->userinfo['address']]);

        return $createUser;
    }

}
