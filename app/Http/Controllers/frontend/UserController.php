<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;



class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $client = Client::where('email', $user->email)->first();
    
        return view('font.profile.profile', compact('user', 'client'));
    }
}
