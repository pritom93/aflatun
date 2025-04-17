<?php

namespace App\Models;
use App\Models\Product;
use App\Models\Color;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $fillable = [
       'product_id', 'size_id', 'color_id', 'cost_price', 'price',
        'stock', 'sku', 'discount', 'image', 'display_status',
    ];
    public function productsCall()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
