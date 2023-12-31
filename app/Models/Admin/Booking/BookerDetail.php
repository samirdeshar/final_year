<?php

namespace App\Models\Admin\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookerDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'bookings_id',
        'member_name',
        'member_email'
    ];
}

