<?php

namespace Sunnyr\Company\Notifications;

use App\Models\User;
use Tzsk\Sms\Builder;
use Illuminate\Bus\Queueable;
use Tzsk\Sms\Channels\SmsChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class OneTimeCodeGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $oneTimeCode;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($oneTimeCode, User $user)
    {
        // dd($this->user);
        $this->oneTimeCode = $oneTimeCode;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', SmsChannel::class];
    }


    public function toSms($notifiable)
    {
        return (new Builder)->via('farazsmspattern') # via() is Optional
            ->send("patterncode=fwyplsfvsy \ncode=" . $this->oneTimeCode->code)
            ->to($this->user->username);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'   =>  ' رابط با نام ' . $notifiable->fullname . ' با شماره همراه ' . $notifiable->username. ' ثبت نام کرد. ',
            'name'  =>  $notifiable->fullname,
        ];
    }
}
