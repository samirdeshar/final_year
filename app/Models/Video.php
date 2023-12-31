<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'status',
        'slug'
    ];
    protected static function booted()
    {
        static::deleting(function ($video) {
            Storage::disk('public')->delete($video->video_url);
        });
    }
}
