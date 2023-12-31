<?php

namespace App\Models\Admin\Award;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardsCategory extends Model
{
    use HasFactory;

    protected $guarded=[

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
        return $this->hasOne(AwardsCategory::class,'id','parent_id');
    }

    public function getSub()
    {
        return $this->hasMany(AwardsCategory::class,'parent_id','id');
    }
}
