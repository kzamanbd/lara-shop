<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $guarded = [];

    protected $appends = ['image_url'];

    protected $casts = [
        'is_new_arrival' => 'boolean',
        'is_best_selling' => 'boolean',
        'is_featured' => 'boolean',
        'is_special_offer' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/product-default.jpg');
        }
        return Storage::url($this->image);
    }

    // Scope methods for filtering products by type
    public function scopeNewArrival($query)
    {
        return $query->where('is_new_arrival', true);
    }

    public function scopeBestSelling($query)
    {
        return $query->where('is_best_selling', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSpecialOffer($query)
    {
        return $query->where('is_special_offer', true);
    }
}
