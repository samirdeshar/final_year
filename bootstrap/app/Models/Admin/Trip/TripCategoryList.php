<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCategoryList extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'category_id',
        'sub_category_id'
    ];

    public function getTrip()
    {
        return $this->hasOne('App\Models\Admin\Trip\Trip', 'id', 'trip_id');
    }

    public function getRelatedTrip()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'category_id', 'trip_id');
    }

    // public function getAllTrips()
    // {
    //     return $this->hasMany(Trip::class);
    // }

    public function getCategoryMain()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategory','id','category_id');
    }

    public function getSubmainCategory()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategory','id','sub_category_id');
    }



}
