<?php

namespace App\Models\Admin\Award;

use App\Models\Admin\Award\AwardsCategory as AwardAwardsCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Award\AwardsCategory;
use Illuminate\Support\Str;

class Awards extends Model
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
    public function getTeamCategory(){
        return $this->belongsTo(AwardsCategory::class, 'cat_id', 'id');

    }
}
