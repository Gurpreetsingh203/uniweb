<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatReaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_chat_id',
        'school_sub_group_id',
        'user_id',
        'emoji',
    ];
}
