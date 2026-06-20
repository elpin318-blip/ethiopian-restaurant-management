<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    
   protected $fillable = [
    'category_id',
    'name',
    'name_am',
    'description',
    'price',
    'stock',  // Add this
    'low_stock_threshold',  // Add this
    'image',
    'is_available',
    'is_spicy',
    'is_vegetarian',
    'is_vegan'
];

    // This defines the relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}