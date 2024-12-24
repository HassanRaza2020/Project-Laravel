<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

use Pusher\Pusher;

class ChatController extends Controller
{



    public function sendMessage(Request $request){



            Chat::create([
             'sender_id' => Auth::id(),
             'receiver_id' => $request->receiver_id,
             'message' =>$request->message,
             'sender_name' =>  'awais',
             'receiver_name' => $request->receiver_name ?? '',
             'message' => $request->message,
             'seen'=>false,
        ]);

            
             
    //Message::create(['receiver_id' => $request->receiver_id,'messages'=>$request->message]);

    //event(new SendUserMessage('rest'));
         $options = ['cluster' => 'eu','useTLS' => true];
         $pusher = new Pusher('244a5e6fc9854d8c119a', 'fc76beb5a3a4399ab7bb', '1908904', $options);
         $pusher->trigger('my-channel', 'my-event', ['message' => $request->message, 'receiver_id' => $request->receiver_id]);
         return "true";

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
  

/*
    public function test(){
        $options = [
            'cluster' => 'eu',
            'useTLS' => true
                          ];
        
             $pusher = new Pusher('244a5e6fc9854d8c119a', 'fc76beb5a3a4399ab7bb', '1908904', $options);
             $pusher->trigger('my-channel', 'my-event', ['message' => 200]);
        
    }

*/

}
