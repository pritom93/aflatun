<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    
    public function newColor()
    {
        return view('backend.pages.color.new_color');
    }
    public function Color(Request $request)
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
                Color::create([
                    'color_name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'color_code' => $request->id
                ]);
                response()->json(['status' => 'success', 'message' => 'Color Added Successfully']);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function viewColor()
    {
        $color = Color::latest()->get();
        return view('backend.pages.color.color_view', ['colors' => $color]);
    }
    public function colorEdit($id)
    {
        $colors = Color::where('id', $id)->first();
        return view('backend.pages.color.color_edit', ['color' => $colors]);
    }
    public function colorDelete($id)
    {
        $color = Color::where('id', $id)->delete();
        return redirect('admins/colors_view')->back();
    }
    public function colorUpdate(Request $request)
    {
        // return response()->json($request->all());
        $updateid = Color::find($request->id);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'native_name' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
            $updateid->update([
                'color_name' => $request->name,
                'color_code' => $request->native_name
            ]);
            return response()->json(["status" => "success", "message" => "Color Update Successfully"]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
