<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forget_Password extends Model
{
    use HasFactory;

    protected $table = 'forget_password';
    protected $fillable = ['email'];


}
