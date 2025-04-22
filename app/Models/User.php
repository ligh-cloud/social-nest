<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Notification;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'google_id',
        'facebook_id',
        'profile_photo_path',
        'role_id',
        'suspended_until',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'suspended_until' => 'datetime',
            'last_active_at' => 'datetime',
        ];
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check if the user is suspended.
     */
    public function isSuspended()
    {
        return $this->suspended_until && $this->suspended_until->isFuture();
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    /**
     * Override the restore method to allow restoration through admin actions
     */
    public function restore()
    {
        // Allow restoration through admin actions
        if (request()->routeIs('admin.users.unban') || request()->routeIs('admin.users.unsuspend')) {
            return parent::restore();
        }
        return false;
    }

    public function lastMessage()
    {
        return $this->hasOne(Chat::class, 'sender_id')
            ->orWhere('receiver_id', $this->id)
            ->latest();
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
