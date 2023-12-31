<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDate extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'date_banner_image',
        'date_description'
    ];
}
