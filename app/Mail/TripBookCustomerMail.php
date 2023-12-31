<?php

namespace App\Mail;

use App\Models\TripBook;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripBookCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $booking=null;
    public function __construct(TripBook $booking)
    {
        $this->booking=$booking;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.clientbooking')
        ->with('data',$this->booking);
    }
}
