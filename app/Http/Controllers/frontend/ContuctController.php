<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContuctController extends Controller
{
    public function font_contuct(){
        return view('font.contucts.contucts');
    }
}
