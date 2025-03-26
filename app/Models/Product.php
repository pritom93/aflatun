<?php

namespace App\Models;
use App\Models\ProductVarient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'unit_id',
        'category_id',
        'sub_category_id',
        'product_name',
        'product_price',
        'product_description',
        'product_image',
        'product_available_quantity',
        'promoted_item',
        'has_varient',
        'vat'
    ];
    public function product_variation()
    {
        return $this->hasMany(ProductVarient::class);
    }
    
    public function product_varients()
    {
        return $this->hasMany(ProductVarient::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_varients', 'product_id', 'color_id')
        ->distinct();
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_varients', 'product_id', 'size_id')
        ->distinct();
    }
}