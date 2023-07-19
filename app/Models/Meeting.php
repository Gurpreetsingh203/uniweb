<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    const AUDIO=1;
    const VIDEO=2;
    protected $fillable = [
        'user_id',
        'host_id',
        'topic',
        'description',
        'type',
        'status',
        'start_time',
        'duration',
        'timezone',
        'start_url',
        'join_url',
        'password',
        'encrypted_password',
        'security',
        'host_video',
        'participant_video',
        'allow_participate_join_everytime',
        'join_before_host',
    ];

    public function getMeetingTypeAttribute()
    {
        if ($this->type == self::AUDIO) {
            return 'Audio';
        } elseif ($this->type == self::VIDEO) {
            return 'Video';
        }
    }

    public function getMeetingDurationAttribute()
    {
        return $this->duration == 0 ? '0s' : CarbonInterval::minutes($this->duration)->cascade()->forHumans(short: true);
    }
}
