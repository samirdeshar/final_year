<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripFaqImage extends Model
{
    use HasFactory;

    protected $fillable=[
        'faq_banner_image'
    ];
}
