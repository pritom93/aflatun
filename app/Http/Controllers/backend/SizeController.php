<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SizeController extends Controller
{
    public function size()
    {
        return view('backend.pages.size.newsize');
    }
    public function newSize(Request $request)
    {
         // return response()->json($request->all());
         try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                Size::create([
                    'size_name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'size_code' => $request->id
                ]);
                response()->json(['status' => 'success', 'message' => 'Size Added Successfully']);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function sizeUpdate(Request $request)
    {
        // return response()->json($request->all());
        $updateid = Size::find($request->id);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'SizeCode' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $updateid->update([
                'size_name' => $request->name,
                'slug' => Str::slug($request->name),
                'size_code' => $request->SizeCode
            ]);
            return response()->json(["status" => "success", "message" => "Color Update Successfully"]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function sizeView()
    {
        $size = Size::latest()->get();
        return view('backend.pages.size.viewsize', ['sizes' => $size]);
    }
    public function sizeDelete($id)
    {
        $size = Size::where('id', $id)->delete();
        return redirect()->back();
    }
}
