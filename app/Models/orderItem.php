<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
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
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }

    public function color()
        {
            return $this->belongsTo(Color::class, 'color_id');
        }

     public function size()
        {
            return $this->belongsTo(Size::class, 'size_id');
        }
        public function client()
    {
    return $this->belongsTo(Client::class);
    }
}
