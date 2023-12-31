<?php

namespace App\Models\Admin\WhyMega;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhyMega extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'sub_title',
        'image',
        'slug',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function megaQstn()
    {
        return $this->hasMany(MegaQstn::class, 'mega_id', 'id');
    }
}
