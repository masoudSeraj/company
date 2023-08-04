<?php

namespace Sunnyr\Company\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Sunnyr\Company\Notifications\OneTimeCodeGeneratedNotification;

class OneTimeCodeGeneratedListener
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
        $user = User::find($event->userId);
        Notification::send($user, new OneTimeCodeGeneratedNotification($event->oneTimeCode, $user));
        // $user->notify(new OneTimeCodeGeneratedNotification($event->oneTimeCode));
    }
}
