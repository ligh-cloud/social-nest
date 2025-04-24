<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class FriendPosted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'friend_post',
            'message' => "{$this->post->user->name} has created a new post.",
            'post_id' => $this->post->id,
            'user_image' => $this->post->user->profile_photo_path,
            'created_at' => now()->toISOString(),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id ?? uniqid('notification_'),
            'type' => 'friend_post',
            'message' => "{$this->post->user->name} has created a new post.",
            'post_id' => $this->post->id,
            'user_image' => $this->post->user->profile_photo_path,
            'created_at' => now()->toISOString(),
        ]);
    }

    // Define a specific broadcast channel name for the notification
    public function broadcastOn()
    {
        return new \Illuminate\Broadcasting\PrivateChannel('App.Models.User.' . $this->notifiable->id);
    }
}
