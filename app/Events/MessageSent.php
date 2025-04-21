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

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        $userIds = [$this->message->sender_id, $this->message->receiver_id];
        sort($userIds);
        return new PrivateChannel('private-chat.' . implode('.', $userIds));
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->load(['sender', 'receiver'])
        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
