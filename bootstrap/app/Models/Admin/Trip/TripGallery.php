<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripGallery extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'gallery_image'
    ];
}
