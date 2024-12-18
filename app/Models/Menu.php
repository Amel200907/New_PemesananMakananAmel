<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'name', 
        'description', 
        'price',
        'image_url',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }
    public function isFavorite()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteItem::class);
    }


}
