<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    public function joinMeeting()
    {
        return $this->hashMany(JoinMeeting::class,'group_chat_id');
    }

    public function reactions(){
        return $this->hasMany(GroupChatReaction::class);
    }
}
