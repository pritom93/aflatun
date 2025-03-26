<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'category_name',
        'category_native_name',
        'parent_categroy',
        'icon',
        'slug',
        'home_view',
        'status'
    ];
}