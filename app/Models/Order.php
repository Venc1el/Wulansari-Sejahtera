<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'order_date',
        'total_amount',
        'shipping_address'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
