<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function Brands()
    {
        return view('backend.pages.brands.brand_form');
    }
    public function createBrands(Request $request)
    {
        //  return response()->json($request->all());
        try {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/brands'), $image_name);
            }
            Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'owner' => $request->woner,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $image_name,
            ]);

            return response()->json("successfully Started");
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
   
    public function viewBrands()
    {
        $brand = Brand::all();
        return view('backend.pages.brands.brand_view', ['brands' => $brand]);
    }
    public function editBrands($id)
    {
        $brand = Brand::where('id', $id)->first();
        return view('backend.pages.brands.brand_edit', ['brands' => $brand]);
    }
    public function UpdateBrands(Request $request)
    {
        try {
            $id = $request->id;
            $brands = Brand::find($id);
            $image_name = $brands->image;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/brands'), $image_name);
                if ($brands->image && file_exists(public_path('images/brands/')
                    . $brands->image)) {
                    unlink(public_path('images/brands/') . $brands->image);
                }
            }

            $brands->update([
                'name' => $request->name,
                'woner' => $request->woner,
                'phone' => $request->phone,
                'address' => $request->address,
                'name' => $request->name,
                'image' => $image_name,
            ]);
            return response()->json("Updated" . $request->id);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function deleteBrands($id)
    {
        try {
            DB::beginTransaction();
            $brands = Brand::find($id);
            if (
                $brands->image &&
                file_exists(public_path('images/brands/') . $brands->image)
            ) {
                unlink(public_path('images/brands/') . $brands->image);
            }
            $brands->delete();
            DB::commit();
            return redirect('admins/brands_view');
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

}
