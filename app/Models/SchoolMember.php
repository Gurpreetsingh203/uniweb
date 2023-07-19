<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'school_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id')->withCount('pendingChat');
    }


}
