<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Events\SendUserMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{



    public function sendMessage(Request $request){

    
//dd(Auth::id());
//dd($request->receiver_id);
        $message = Chat::create([
             'sender_id' => Auth::id(),
             'receiver_id' => $request->receiver_id,
             'message' =>$request->message,
             'sender_name' => Auth::user()->username,
             'receiver_name' => $request->receiver_name,
             'message' => $request->message,
             'seen'=>false,
        ]);


      // dd($request->message);   
             
        Message::create(['receiver_id' => $request->receiver_id,
        'messages'=>$request->message]);

            

        broadcast(new SendUserMessage($message))->toOthers();

        return response()->noContent();

    }


     public function message($receiver_id, $username) 
     {
      //dd($receiver_id,$username);
        $chat = Chat::where('receiver_id', $receiver_id)->get();
        return view('chat.chat-view', compact('chat','username'));
    }
      


    public function markAsSeen($messageID){
       
        $message = Message::find($messageID);
        if ($message && $message->receiver_id == Auth::id()){
            $chat = Chat::where('receiver_id',$message->receiver_id )->first();
            
            $chat ->update(['seen'=>true]); 
        }        

    }



}
