<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, Notifiable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
    ];

    /**
     * Get the user that created the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the notifications related to the event.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Trigger a notification for the event.
     */
    public function triggerEventNotification($user)
    {
        // Example of sending a notification when an event is created
        $user->notify(new EventCreatedNotification($this));
    }
}
