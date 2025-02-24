<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /** @use HasFactory<\Database\Factories\OrderProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'updated_by',
        'created_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
