<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSubGroupMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_sub_group_id',
        'user_id'
    ];

    public function subGroup(){
        return $this->belongsTo(SchoolSubGroup::class,'school_sub_group_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id')->withCount('pendingChat');
    }
}
