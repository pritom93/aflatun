<?php

namespace App\Http\Controllers\verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\welcomeemail;
use App\Models\AttrValue;
use App\Models\Attribute;

class EmailController extends Controller
{
    public function sendEmail(Request $request){
        $sendTo = "aakmam583@gmail.com";
        $data = [
            'name' => 'AFLATUN',
            'message' => 'Hello Customer, Good Evining'
        ];
        Mail::to($sendTo)->send(new welcomeemail($data));
        return "Mail sent successfully!";
    }

    public function attrValueData(Request $request){
            // return response()->json($request->attribute_ids);
            $id = $request->attribute_ids;
            $attrValue = Attribute::with('attrvalue:id,name,attrname_id')->whereIn('id', $id)->get();
            return $attrValue;
    }
}
