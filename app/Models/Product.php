<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
     // Allow these fields to be filled via forms
    protected $fillable = [
        'sku', 'name', 'slug', 'category_id', 'brand_id', 
        'price', 'stock', 'is_visible', 'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_visible' => 'boolean',
    ];

    // Define relationships
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
     public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
