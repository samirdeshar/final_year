<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function menu(){
        return $this->hasMany(Menu::class, 'category_slug');
    }
}
