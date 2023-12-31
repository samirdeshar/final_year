<?php
namespace App\Models\Admin\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Trip\Trip;

class Booking extends Model
{
    use HasFactory;

    protected $fillable=[
        'trip_id',
        'full_name',
        'email',
        'phone_num',
        'street_address',
        'country',
        'city',
        'no_adults',
        'no_children',
        'passport',
        'find_mega',
        'travelled',
        'insuranced',
        'terms_of_use',
        'comments',
        'subscribe'
    ];
    
    public function trip()
    {
        return $this->hasOne('App\Models\Admin\Trip\Trip','id','trip_id');
    }
}
