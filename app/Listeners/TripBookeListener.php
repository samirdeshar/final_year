<?php

namespace App\Listeners;

use App\Mail\TripBookMail;
use App\Events\TripBookEvent;
use App\Mail\TripBookCustomerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripBookeListener
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
     * @param  \App\Events\TripBookEvent  $event
     * @return void
     */
    public function handle(TripBookEvent $event)
    {
        Mail::to($event->setting->email ?? 'rupakotholidays1@gmail.com')->send(new TripBookMail($event->data));
        Mail::to($event->data->email)->send(new TripBookCustomerMail($event->data));
    }
}
