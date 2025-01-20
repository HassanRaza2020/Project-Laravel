<?php

namespace App\Services;

use App\Repositories\UserRepository;


class UserService {

  protected  $userRespository;
  public function __construct(UserRepository $userRespository)
  {
         $this->userRespository = $userRespository;
  }

  public function create($data){
    $this->userRespository->create($data);

  }



}