<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Log;

class SendUserMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
    //    dd($message);
        $this->message = $message;
    
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        Log::info("broadcastOn");
        // Broadcast on a private channel for the receiver
        return new Channel('my-channel');
    }

    /**
     * Data to broadcast with the event.
     */
    public function broadcastWith()
    {
        
        Log::info("broadcastWith");
        // return ['message' =>"1122"];

        return [
            'message' => $this->message->message ?? 'awais',  // Include the message content
        ];
    }


//     public function broadcastAs()
// {
//     Log::info("broadcastAs");
//     return ['newMessage'];
// }


    
}
