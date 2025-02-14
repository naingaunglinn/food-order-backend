<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'category_id', 
        'description', 
        'price', 
        'stock', 
        'image'
    ];

    // Define the relationship with Category (many-to-one)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
