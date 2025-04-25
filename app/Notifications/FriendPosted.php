<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class FriendPosted extends Notification
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'user_id' => $this->post->user_id,
            'text' => $this->post->text,
            'image' => $this->post->image,
            'privacy' => $this->post->privacy,
            'created_at' => $this->post->created_at,
        ];
    }
}
