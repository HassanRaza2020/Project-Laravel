<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'message', 
        'sender_name', 
        'receiver_name', 
        'text', 
        'seen'
    ];
    


}