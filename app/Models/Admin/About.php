<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'slogan',
        'background_text',
        'status',
        'description',
        'team_title',
        'team_backgroundtext',
        'team_description',
        'team_features',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
