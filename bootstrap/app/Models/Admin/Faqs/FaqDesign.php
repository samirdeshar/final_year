<?php

namespace App\Models\Admin\Faqs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqDesign extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'slogan',
        'image',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
