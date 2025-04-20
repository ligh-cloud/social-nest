<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    protected $appends = ['likes_status'];
    protected $fillable = [
        'user_id',
        'image',
        'content',
        'privacy',
    ];

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLikesStatusAttribute()
    {
        $user = Auth::user();
        if (!$user) return false;

        return $this->likes()->where('user_id', $user->id)->exists();
    }


}
