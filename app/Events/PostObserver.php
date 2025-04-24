<?php

namespace App\Observers;

use App\Models\Post;
use App\Notifications\FriendPosted;
use Illuminate\Support\Facades\Notification;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        // Get user friends
        $friends = $post->user->friends ?? collect();

        // If the post is not private, notify all friends
        if ($post->privacy !== 'private' && $friends->count() > 0) {
            Notification::send($friends, new FriendPosted($post));
        }
    }
}
