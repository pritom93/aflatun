<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];
    public function client()
    {
        return $this->hasOne(Client::class, 'email', 'email');
    }
}
