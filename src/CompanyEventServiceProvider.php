<?php

namespace Sunnyr\Company;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CompanyEventServiceProvider extends ServiceProvider
{
        /**
     * The event handler mappings for the application.
     *
     * @var array
     */

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            'Sunnyr\Company\Events\AgentCreated',                
            'Sunnyr\Company\Listeners\AgentCreatedListener',            
        );

        Event::listen(
            'Sunnyr\Company\Events\OneTimeCodeGeneratedEvent',
            'Sunnyr\Company\Listeners\OneTimeCodeGeneratedListener'
        );
    }
}
