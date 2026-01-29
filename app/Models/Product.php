<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/products/' . $this->image);
        }
        return asset('images/no-image.png');
    }
}

