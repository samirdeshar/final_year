<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBack extends Model
{
    use HasFactory;

    protected $fillable=[
        'country',
        'destination',
        'trip_type',
        'trip_start',
        'trip_end',
        'price_range',
        'adults',
        'childs',
        'infants',
        'full_name',
        'contact_num',
        'email',
    ];

}
