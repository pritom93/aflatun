<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'color_id',
        'size_id',
        'unit_price',
        'quantity',
        'discount',
        'total_price'
    ];
    protected $table = 'order_items';
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
