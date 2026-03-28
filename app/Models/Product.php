<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     // Allow these fields to be filled via forms
    protected $fillable = [
        'sku', 'name', 'slug', 'category_id', 'brand_id', 
        'price', 'stock', 'is_visible', 'image'
    ];

    // Define relationships
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
