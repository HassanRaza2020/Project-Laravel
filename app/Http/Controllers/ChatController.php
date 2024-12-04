<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\SendUserMessage;

class ChatController extends Controller
{

    
    public function ChatView(){

    return view('chat.chat_module');

    }



}
