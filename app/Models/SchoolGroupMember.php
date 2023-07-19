<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolGroupMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_group_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id')->withCount('pendingChat');
    }

    // public function unseenMsg()
    // {
    //     return $this->hasMany(GroupChatSeen::class,'school_sub_group_id')->whereUserId(auth()->user()->id);
    // }
}
