<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class UserRepository {
  protected $userRepository;

   public function __construct(User $userRepository){
           $this->userRepository = $userRepository;
   }
   
   public  function create($request)
   {

    $createUser = $this->userRepository::create([
        'username' => $request->userinfo['username'],
        'email' =>    $request->userinfo['email'],
        'password' => Hash::make($request->userinfo['password']),
        'address' =>  $request->userinfo['address']]);
     
     return $createUser;
   }







}
