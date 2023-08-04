<?php

namespace Sunnyr\Company\Events;

use Sunnyr\Company\Models\Agent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AgentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $agent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }
}
