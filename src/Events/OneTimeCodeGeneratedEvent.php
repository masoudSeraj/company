<?php

namespace Sunnyr\Company\Events;

use App\Models\OneTimeCode;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class OneTimeCodeGeneratedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $oneTimeCode;
    public $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OneTimeCode $oneTimeCode, $userId)
    {
        $this->oneTimeCode = $oneTimeCode;
        $this->userId = $userId;
    }
}
