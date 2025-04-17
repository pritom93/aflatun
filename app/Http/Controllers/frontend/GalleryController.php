<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class GalleryController extends Controller
{
    public function font_ofGallery(){
        $gallery = Product::select('image')->get();
        // return $gallery;
        return view('font.gallery.gallery',['galleries' => $gallery]);
    }
}
