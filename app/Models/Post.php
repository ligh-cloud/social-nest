<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
}
