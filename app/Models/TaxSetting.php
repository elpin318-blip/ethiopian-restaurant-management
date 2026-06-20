<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxSetting extends Model
{
    protected $fillable = ['name', 'percentage', 'is_active', 'is_default'];
}