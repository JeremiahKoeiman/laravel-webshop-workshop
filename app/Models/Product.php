<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->hasMany(Price::class);
    }

    public function get_latest_price()
    {
        return $this->hasOne('App\Models\Price')->orderBy('effdate', 'desc');
    }
}
