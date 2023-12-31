<?php

namespace App\Models\Admin\Faqs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralFaq extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_descriptions',
    ];
}
