<?php

namespace App\Models\Admin\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug',
        'cat_id',
        'sub_cat_id',
        'designation',
        'description',
        'fb_link',
        'twitter_link',
        'instagram_link',
        'status',
        'image',
        'in_order',
        'email',
        'contact_no',
    ];

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
    public function getTeamCategory(){
        return $this->belongsTo(TeamCategory::class, 'cat_id', 'id');

    }

}
