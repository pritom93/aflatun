<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id',  'payment_method', 'payment_status', 'shipping_charge',
    'discount', 'subtotal', 'tax', 'total', 'delivery_status', 'delivery_date',
          'order_status', 'order_date',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
