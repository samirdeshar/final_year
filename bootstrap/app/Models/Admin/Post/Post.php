<?php

namespace App\Models\Admin\Post;

use Str;
use App\Models\Admin\Post\PostTag;
use App\Models\Admin\Post\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'tag_id',
        'user_id',
        'cat_id',
        'slug',
        'description',
        'summary',
        'status',
        'image',
        'meta_titles',
        'meta_keywords',
        'meta_descriptions'

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


    public function getCat()
    {
        return $this->belongsTo(PostCategory::class,'cat_id','id');
    }


    public function category()
    {
        return $this->belongsTo(PostCategory::class,'cat_id','id');
    }

    public function getTag()
    {
        return $this->hasOne('App\Models\Admin\Post\PostTag','id','tag_id');
    }



}
