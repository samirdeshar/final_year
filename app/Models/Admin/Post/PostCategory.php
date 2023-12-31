<?php

namespace App\Models\Admin\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'description',
        'user_id',
        'parent_id'
    ];

    public function getRules()
    {
        $rules=[
            'name'=>'required|string',
            'description'=>'nullable|string',
            'parent_id'=>'nullable|exists:post_categories,id',
            'user_id'=>'nullable|exists:users,id'
        ];

        return $rules;
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
// Get blogs post
    public function posts()
    {
        return $this->hasMany(Post::class,  'cat_id', 'id');
    }

    public function getCat()
    {
        return $this->hasOne('App\Models\Admin\Post\PostCategory','id','parent_id');
    }
}
