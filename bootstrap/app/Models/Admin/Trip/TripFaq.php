<?php

namespace App\Models\Admin\Trip;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripFaq extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'faq_question',
        'faq_answer'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }
}
