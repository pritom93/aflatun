<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
protected $table = 'clients';
    protected $fillable = [
        'first_name',
        'last_name',
        'division',
        'district',
        'home_district',
        'address',
        'email',
        'password',
        'terms_accepted',
        'image',
    ];
    public function client()
    {
    return $this->belongsTo(Client::class, 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
