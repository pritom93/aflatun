<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    public function font_fashion(){
        return view('font.fashion.fashions');
    }
}
