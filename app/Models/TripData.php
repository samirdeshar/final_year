<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripData extends Model
{
    use HasFactory;

    protected $fillable=[
        'sightseeing_places',
        'best_time',
        'trip_info',
        'imp_note',
        'travel_date',
        'min_travel',
        'trip_safety',
        'useful_tip',
        'hike_trip',
        'optional_tour',
        'trip_id'
    ];
}
