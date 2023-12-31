<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'icon',
        'logo',
        'logo2',
        'site_name',
        'quatation',
        'fb_link',
        'twitter_link',
        'linkedin_link',
        'insta_link',
        'youtube_link',
        'pinterest_link',
        'google_plus',
        'address',
        'location_url',
        'email',
        'phone',
        'contact',
        'contact_second',
        'meta_title',
        'meta_keywords',
        'meta_description',

        // Design
        'mega_title',
        'mega_sub_title',
        'mega_background_text',
        'mega_banner_image',
        'trip_title',
        'trip_sub_title',
        'trip_background_text',
        'trip_banner_image',
        'information_title',
        'information_sub_title',
        'information_background_text',
        'information_banner_image',
        'adventure_title',
        'adventure_sub_title',
        'adventure_background_text',
        'adventure_banner_image',


        // hikes Design
        'hikes_title',
        'hikes_description',
        'hikes_image',

        'certificate_image',
        'payment_image'
    ];
}

