<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'name', 'phone', 'email', 'address', 'payment_method', 
        'receiving_time', 'shipping_charge', 'subtotal', 'tax', 'total'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
