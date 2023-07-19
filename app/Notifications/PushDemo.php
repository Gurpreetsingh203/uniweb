<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PushDemo extends Notification
{

    use Queueable;

    protected $val;
    public function __construct($h)
    {
        //
        $this->val = $h;
    }


    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        // return (new WebPushMessage)
        //     ->title('I\'m Notification Title')
        //     ->icon('/notification-icon.png')
        //     ->body('Great, Push Notifications work!')
        //     ->action('View App', 'notification_action');

        return (new WebPushMessage)
            ->title($this->val['title'])
            ->body($this->val['body']);
            // ->action('View', 'notification_action');
    }
}
