<?php

namespace App\Providers;

use App\Events\CallBackEvent;
use App\Events\TripBookEvent;
use App\Listeners\CallBackListener;
use App\Listeners\TripBookeListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CallBackEvent::class=>[
            CallBackListener::class
        ],
        TripBookEvent::class=>[
            TripBookeListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
