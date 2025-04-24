<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class FriendPosted extends Notification
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function via($notifiable)
    {
        return ['database' , 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'friend_post',
            'message' => "{$this->post->user->name} has created a new post.",
            'post_id' => $this->post->id,
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => 'friend_post',
            'message' => $this->post->user->name . ' has created a new post.',
            'post_id' => $this->post->id,
        ]);
    }
}
