<?php

namespace App\Models\Admin\Inquiry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable=[
        'full_name',
        'email',
        'phone',
        'country',
        'find_mega',
        'message'
    ];
}

