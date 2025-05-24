<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Attribute;
use App\Models\AttrValue;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    public function Attribute()
    {
        return view('backend.pages.attribute.new_attribute');
    }
    public function newAttribute(Request $request)
    {
        // return response()->json($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'native' => 'nullable|string|max:255',
                'des' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                Attribute::create([
                    'name' => $request->name,
                    'native_name' => $request->native,
                    'slug' => Str::slug($request->name),
                    'description' => $request->des,
                ]);
                return response()->json("Attribute Added SuccessFully");
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function editAttribute($id)
    {
        $attr = Attribute::where('id', $id)->first();
        return view('backend.pages.attribute.attr_edit', ['attrs' => $attr]);
    }
    public function updateAttribute(Request $request)
    {
        $id = $request->id;
        $attr = Attribute::find($id);
        // return response()->json($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'native' => 'nullable|string|max:255',
                'des' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                $attr->update([
                    'name' => $request->name,
                    'native_name' => $request->native,
                    'slug' => str::slug($request->name),
                    'description' => $request->des,
                ]);
                return response()->json("Attribute Update SuccessFully");
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function viewAttribute()
    {
        $attrs = Attribute::with('attrvalue:id,attrname_id,name')->get();
        // return $attrs;
        // $attrs = DB::table('attributes')
        // ->join('attrvalues', 'attributes.id', '=', 'attrvalues.attrname_id')
        // ->select(
        //     'attributes.*',  
        //     'attrvalues.name as value_name'
        // )
        // ->latest('attrvalues.created_at')
        // ->get();

        return view('backend.pages.attribute.attr_view', ['attrs' => $attrs]);
    }
    public function deleteAttribute(Request $request)
    {
        $id = $request->id;
        try {
            $attr = Attribute::where('id', $id)->delete();
            if ($attr->fails()) {
                return response()->json([
                    'errors' => $attr->errors()
                ], 422);
            }
        } catch (\Throwable $th) {
            response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    // -----------
    public function attrValue()
    {
        $attr = Attribute::get();
        return view('backend.pages.attr_val.new_value', ['attrs' => $attr]);
    }
    public function newAttrValue(Request $request)
    {
        //return response()->json($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'attrname' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                // 'des' => 'required|string|max:255',
                // 'count' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                $insert =  AttrValue::create([
                    'attrname_id' => (int)$request->attrname,
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'description' => $request->name,
                    'count' => 0,
                ]);
                return response()->json('Data Inserted Successfully');
            }
        } catch (\Throwable $th) {
            response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function viewAttrValue()
    {
        $viewdata = AttrValue::with('attribute:id,name')->get();
        // dd($viewdata);
        return view('backend.pages.attr_val.view_attr', [
            'attrval' => $viewdata
        ]);
    }
    public function editAttrValue($id)
    {
        $editattr = AttrValue::where('id', $id)->first();
        return view('backend.pages.attr_val.edit_value', [
            'attrval' => $editattr
        ]);
    }
    public function updateAttrValue(Request $request)
    {
        $id = AttrValue::find($request->id);
        try {
            $validator = Validator::make($request->all(), [
                'attrname' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'des' => 'required|string|max:255',
                'count' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                $id->update([
                    'attrname_id' => (int)$request->attrname,
                    'name' => $request->name,
                    'description' => $request->des,
                    'count' => (int)$request->count,
                ]);
                return response()->json('Data Update Successfully');
            }
        } catch (\Throwable $th) {
            response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
        return response()->json($id);
    }
    public function deleteAttrValue($id)
    {
        $delete = AttrValue::where('id', $id)->delete();
        if ($delete == true) {
            return redirect()->back()->with(['status' => 'Deleted']);
        }
    }
}
