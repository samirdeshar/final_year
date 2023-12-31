<?php

namespace App\Models\Admin\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'parent_id',
        'name',
        'slug',
        'description',
        'user_id'
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

    public function getCat()
    {
        return $this->hasOne('App\Models\Admin\Team\TeamCategory','id','parent_id');
    }

    public function getSub()
    {
        return $this->hasMany('App\Models\Admin\Team\TeamCategory','parent_id','id');
    }
}
