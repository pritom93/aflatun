<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttrValue extends Model
{
    use HasFactory;
    protected $table = 'attrvalues';

    protected $fillable = ['attrname_id', 'name', 'description', 'count'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attrname_id')->withDefault([
            'id' => 0,
            'name' => 'Aflatun'
        ]);
    }
}