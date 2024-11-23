<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;




class User extends Authenticatable implements AuthMustVerifyEmail
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'email_verified_at'
    ];
}
