<?php

namespace App\Models;
use App\Models\ProductVariant;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $fillable = [
        'color_name',
        'color_code'
    ];
            public function productVariants()
        {
            return $this->hasMany(ProductVariant::class);
        }
}