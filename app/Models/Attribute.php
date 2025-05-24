<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'native_name',
        'slug',
        'description',
    ];
    public function attrvalue()
    {
        return $this->hasMany(AttrValue::class,'attrname_id');
    }
}