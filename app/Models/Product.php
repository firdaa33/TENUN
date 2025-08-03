<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Agar route model binding pakai slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi ke review (jika kamu pakai)
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    // Relasi ke rating
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    // Rata-rata rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    protected static function booted()
    {
    static::creating(function ($product) {
        $product->slug = Str::slug($product->name);
    });
    }
    public function getImageUrlAttribute()
    {
    return asset($this->image);
    }

}
