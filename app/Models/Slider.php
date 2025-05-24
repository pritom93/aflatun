<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
      'title', 'subtitle', 'image', 'image_url', 'button_text', 'button_link',
    'page', 'precedence', 'is_active', 'starts_at', 'ends_at',
    ];
}
