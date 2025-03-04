<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttrValue extends Model
{
    use HasFactory;
    protected $table = 'attrvalues';

    protected $fillable = ['attrname_id', 'name', 'description', 'count'];
    protected function attribute(){
        return $this->belongsTo();
    }
}