<?php

namespace App\Models\Admin\Partner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'show_in',
        'image',
        'url',
        'status'
    ];
}
