<?php

namespace App\Models;
use App\Models\ProductVariant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'designer_id',
        'unit_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'name',
        'slug',
        'price',
        'description',
        'image',
        'available_quantity',
        'promoted_item',
        'has_varient',
        'vat',
        'status',
    ];
    public function product_variation()
    {
        return $this->hasMany(ProductVariant::class);
    }
    
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_variants', 'product_id', 'color_id')
        ->distinct();
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_variants', 'product_id', 'size_id')
        ->distinct();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}