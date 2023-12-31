<?php

namespace App\Models\Admin\WhyMega;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MegaQstn extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'mega_id',
        'question',
        'answer',
    ];

    public function whyMega()
    {
        return $this->belongsTo(WhyMega::class, 'mega_id', 'id');
    }

}
