<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'event_name',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'images',
        'banner',
        'thumbnail',
        'organizer',
    ];
    protected $casts = [
        'images' => 'array',
    ];
                            public function getBannerUrlAttribute()
                        {
                            return asset('storage/' . $this->banner);
                        }
}
