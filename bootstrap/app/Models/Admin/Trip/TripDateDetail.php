<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDateDetail extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'date_start',
        'date_trip_status',
        'date_cost',
        'date_request'
    ];
}
