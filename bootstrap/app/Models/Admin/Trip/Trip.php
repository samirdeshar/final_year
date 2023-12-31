<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'trip_cost',
        'mega_special_trip',
        'home_page_slider',
        'classic_layout',
        'show_on_home_page',
        'description',
        'overview',
        'itinerary',
        'date_price',
        'reviews',
        'faq',
        'train_yourself',
        'gear_list',
        'banner_image',
        'notes',
        'user_id',
        'tag_id',
        'meta_titles',
        'meta_keywords',
        'meta_descriptions',
        'status',
        'slug',
        'slogan',
        'summary',
        'duration',
        'trip_duration'
    ];


    public function getSub()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripCategory','parent_id','id');
    }

    public function getSlugs($title)
    {
        $slug=\Str::slug($title);
        if($this->where('slug',$slug)->count() >0)
        {
            $slug=$slug.'-'.rand(0,99999);
            $this->getSlugs($slug);
        }

        return $slug;
    }


    public function getIteneary()
    {
        return $this->hasMany(TripItineary::class, 'trip_id', 'id');
    }

    public function getParentCat()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategoryList','trip_id','id');
    }

    public function getOverView()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripOverview','trip_id','id');
    }

    public function getTrain()
    {
        return $this->hasOne('App\Models\Admin\Trip\TrainYourSelf','trip_id','id');
    }

    public function getGallery()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripGallery','trip_id','id');
    }

    public function getGear()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripGear','trip_id','id');
    }

    public function getFaq()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripFaq','trip_id','id');
    }

    public function getDate()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripDate','trip_id','id');
    }

    public function getDateDetail()
    {
        return $this->hasMany('App\Models\Admin\Trip\TripDateDetail','trip_id','id');
    }

    public function getTripCat()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategoryList','trip_id','id');
    }

    public function getParentCategory()
    {
        return $this->hasOne('App\Models\Admin\Trip\TripCategoryList','trip_id','id');
    }

    public function tripFaq()
    {
        return $this->hasMany(TripFaq::class, 'trip_id', 'id');
    }
}

