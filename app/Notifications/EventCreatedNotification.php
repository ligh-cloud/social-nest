<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class EventCreatedNotification extends Notification
{
    use Queueable;

    protected $event;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Event $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the data that should be stored in the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->title,
            'event_description' => $this->event->description,
            'message' => "A new event titled '{$this->event->title}' has been created by {$this->event->user->name}.",
        ];
    }
}
