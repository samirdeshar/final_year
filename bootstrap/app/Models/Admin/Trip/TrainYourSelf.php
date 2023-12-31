<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainYourSelf extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'train_description',
        'train_banner_image'
    ];
}
