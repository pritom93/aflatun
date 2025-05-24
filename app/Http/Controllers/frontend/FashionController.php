<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Designer;
use App\Models\Banner;
use App\Models\Slider;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    public function font_fashion(){
        $designer = Designer::get();
        $slider = Banner::get();
        return view('font.fashion.fashions',[
            'designers' => $designer,
            'sliders' => $slider,
        ]);
    }
}
