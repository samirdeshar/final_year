<?php

namespace App\Models\Admin\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'show_in',
        'slug',
        'description',
        'summary',
        'status',
        'image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'icon'
    ];
}
