<?php

namespace App\Http\Controllers\Admin\BookingList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Booking\Booking;
use App\Models\TripBook;

class BookingListController extends Controller
{
    public function list()
    {
        $booking=TripBook::with('trip')->orderBy('id','DESC')->get();
      
        return view('admin.booking.bookinglist')
        ->with('bookings',$booking)
        ->with('n',1);
    }
}
