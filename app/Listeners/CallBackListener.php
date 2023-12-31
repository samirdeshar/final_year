<?php

namespace App\Listeners;

use App\Mail\CallBackMail;
use App\Events\CallBackEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CallBackListener
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
     * @param  \App\Events\CallBackEvent  $event
     * @return void
     */
    public function handle(CallBackEvent $event)
    {
        Mail::to($event->data->email)->send(new CallBackMail($event));
        Mail::to($event->setting->email ?? 'rupakotholidays1@gmail.com')->send(new CallBackMail($event));
    }
}
