<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    // User to be broadcasted
    public $user;
    // Message that this user has sent
    public $message;

    public function __construct(User $user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    //  Channel where we will broadcast the event
    public function broadcastOn()
    {
        return new PresenceChannel('chat');
    }
}
