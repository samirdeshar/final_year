<?php

namespace App\Models\Admin\Trip;

use Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TripCategory extends Model
{
    use HasFactory;


    protected $fillable=[
        'name',
        'slug',
        'parent_id',
        'display',
        'description',
        'summary',
        'image',
        'user_id'
    ];

    public function getSlugs($title)
    {
        $slug=Str::slug($title);
        if($this->where('slug',$slug)->count() >0)
        {
            $slug=$slug.'-'.rand(0,99999);
            $this->getSlugs($slug);
        }

        return $slug;
    }


    public function category_trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'sub_category_id', 'trip_id')->limit(5);
    }

    public function getCat()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategory','id','parent_id');
    }

    public function getSub()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripCategory','parent_id','id');
    }

    public function getCategoryList()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripCategoryList','category_id','id');
    }

    public function category_trip()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'sub_category_id', 'trip_id');
    }


    public function getCategoryTrip()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'category_id', 'trip_id');
    }


    public function getChild()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripCategory','parent_id','id');
    }

    public function getSortCategoryTripByHigh()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'category_id', 'trip_id')->orderBy('trip_cost','desc');
    }

    public function getSortCategoryTripByLow()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'category_id', 'trip_id')->orderBy('trip_cost','asc');
    }

    public function category_Hightrip()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'sub_category_id', 'trip_id')->orderBy('trip_cost','desc');
    }

    public function category_Lowtrip()
    {
        return $this->belongsToMany(Trip::class, 'trip_category_lists', 'sub_category_id', 'trip_id')->orderBy('trip_cost','asc');
    }










}
