<?php

namespace Sunnyr\Company\Listeners;

use Illuminate\Support\Facades\Notification;
use Sunnyr\Company\Notifications\AgentCreatedNotification;

class AgentCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->agent->user, new AgentCreatedNotification($event->agent));
    }
}
