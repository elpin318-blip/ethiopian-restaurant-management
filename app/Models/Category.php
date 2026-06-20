<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'name_am',
        'description',
        'image',
        'is_active'
    ];

    // This defines the relationship to Foods
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}