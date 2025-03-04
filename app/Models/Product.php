<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'unit_id',
        'category_id',
        'product_name',
        'product_price',
        'product_description',
        'product_image',
        'product_available_quantity',
        'product_size',
        'color',
        'promoted_item',
        'vat'
    ];
}