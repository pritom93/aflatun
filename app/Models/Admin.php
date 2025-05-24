<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_area_id',
        'role_id',
        'reset_token',
        'avatar',
        'status',
    ];
    public function roles(){
        return $this->belongsTo(Role::class);
    }
}