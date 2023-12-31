<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public const SHOWON  = [
        'header' => '1',
        'footer' => '2',
        'header_footer' => '3',
    ];

    protected $fillable = [
        'name',
        'slug',
        'category_slug',
        'position',
        'main_child',
        'parent_id',
        'header_footer',
        'banner_image',
        'image',
        'page_title',
        'content',
        'external_link',
        'meta_title',
        'meta_keywords',
        'title_slug',
        'content_slug',
        'publish_status',
        'meta_description',
        'og_image',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_slug', 'slug');
    }


    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('publish_status',1);
    }
}
