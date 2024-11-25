<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend this class, not implement it
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // If needed, you can cast the email_verified_at to a date
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
