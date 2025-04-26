<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes , Notifiable;

    protected $appends = ['likes_status'];
    protected $fillable = [
        'user_id',
        'image',
        'text',
        'privacy',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function getLikesStatusAttribute()
    {
        $user = Auth::user();
        if (!$user) return false;

        return $this->likes()->where('user_id', $user->id)->exists();
    }
    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_posts');
    }
}
