<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
   
{
    use HasFactory;
    protected $guard = 'customer';
    protected $fillable=[
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_num',
        'password',
        'country',
        'city',
        'image'
    ];

    public function getTrip()
    {
        return $this->hasMany(TripBook::class,'customer_id','id')->orderByDesc('created_at');
    }
}
