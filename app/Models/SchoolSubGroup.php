<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSubGroup extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'school_group_id',
        'name',
        'timeframe',
        'expire_at'
    ];
}
