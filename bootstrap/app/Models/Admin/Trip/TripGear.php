<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGear extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'gear_banner_image',
        'gear_description'
    ];
}
