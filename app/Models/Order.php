<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    
  
   protected $fillable = [
    'order_number',
    'user_id',  // This can be null
    'table_id',
    'customer_name',
    'customer_phone',
    'subtotal',
    'tax',
    'service_charge',
    'total',
    'status',
    'payment_status'
];

    protected $casts = [
        'ordered_at' => 'datetime',
        'completed_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'service_charge' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}