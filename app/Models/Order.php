<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone_number',
        'otp_code',
        'total_price',
        'status',
        'updated_by',
        'created_by',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
