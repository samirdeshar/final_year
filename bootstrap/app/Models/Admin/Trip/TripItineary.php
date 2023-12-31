<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripItineary extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'itineary_map_lattitude',
        'itineary_map_logitude',
        'itslogan',
        'itineary_heading',
        'itineary_description'
    ];

    public function trip(){
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }
}
