<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashierShift extends Model
{
    protected $fillable = [
        'user_id', 'login_time', 'logout_time', 'opening_balance', 
        'closing_balance', 'expected_balance', 'difference', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}