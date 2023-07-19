<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'profile',
        'email',
        'password',
        'country_code',
        'contact',
        'address',
        'role',
        'is_social',
        'provider_type',
        'provider_id',
        'zoom_client_id',
        'zoom_client_secret_key'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!is_null($user->password)) {
                $user->password = bcrypt($user->password);
            }
        });
    }

    public function pendingChat()
    {
        return $this->hasMany(Chat::class, 'sender_id')
        ->whereReceiverId(auth()->user()->id)
        ->whereSeen(0);
    }
}
