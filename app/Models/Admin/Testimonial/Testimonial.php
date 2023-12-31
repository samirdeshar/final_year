<?php

namespace App\Models\Admin\Testimonial;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'image',
        'type',

        //featured of testimonial
        'name',
        'email',
        'phone',
        'address',
        'trip',
        'country',
        'website',
        'summary'
    ];
}
