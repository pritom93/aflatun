<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;
    protected $table = 'designers'; // explicitly set table name

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'image',
        'bio',
        'status',
    ];
}
