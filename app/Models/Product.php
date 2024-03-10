<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carts()
    {
        return $this->BelongsToMany(Cart::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    public function scopeNotSold($query)
    {
        return $query->where('sold', false);
    }
}
