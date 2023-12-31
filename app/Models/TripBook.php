<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripBook extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'trip_type',
        'arrival',
        'departure',
        'num_of_pax',
        'adults',
        'childs',
        'infants',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'contact_num',
        'email',
        'country',
        'city',
        'passport',
        'additional_info',
        'extra_faciulity',
        'know_from',
        'customer_id'
    ];


    public function trip()
    {
        return $this->hasOne('App\Models\Admin\Trip\Trip','id','trip_id');
    }
}

