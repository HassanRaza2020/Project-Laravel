<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class User extends Authenticatable implements AuthMustVerifyEmail
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
    ];
}
