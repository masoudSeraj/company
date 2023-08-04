<?php

namespace Sunnyr\Company\Notifications;

use Tzsk\Sms\Builder;
use Illuminate\Bus\Queueable;
use Sunnyr\Company\Models\Agent;
use Tzsk\Sms\Channels\SmsChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgentCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $agent;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
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
            ->send("patterncode=yjvr9njc38x835o \nname=" . $this->agent->user->fullname)
            ->to($this->agent->user->username);
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
            'message'   =>  ' رابط با نام ' . $this->agent->user->fullname . ' با شماره همراه ' . $this->agent->user->username. ' ثبت نام کرد. ',
            'name'  =>  $this->agent->user->fullname,
            'company_phone' =>  $this->agent->company_number
        ];
    }
}
