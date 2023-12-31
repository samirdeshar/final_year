<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripOverview extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'overview_slogan',
        'overview_image',
        'overview_trip_type_summary',
        'overview_trip_summary',
        'overview_description',
        'overview_trip_code',
        'overview_duration',
        'overview_group_sizes',
        'overview_best_season',
        'overview_level_start',
        'overview_level_end',
        'overview_trek_day',
        'overview_activities',
        'overview_arrival_city',
        'overview_departure_city',
        'overview_transportation',
        'overview_trip_route',
        'overview_cost_includes',
        'overview_cost_excludes',
        'overview_price_schedule'
    ];
}

