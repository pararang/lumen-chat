<?php

namespace App\Providers;

use App\Events\MessageEvent;
use App\Listeners\MessageListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessageEvent::class => [
            MessageListener::class,
        ],
    ];
}
