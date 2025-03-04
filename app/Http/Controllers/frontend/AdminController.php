<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\AttrValue;

class AdminController extends Controller
{
    public function throwBackend()
    {
        return view('backend.pages.dashboard');
    }
    public function newAdmin()
    {
        return view('backend.pages.admin.newadmin');
    }
    public function createAdmin(Request $request)
    {


        $reqData = $request->validate([
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        return response()->json($request->all());
        if ($request->hasFile('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
            $request['avatar']->move(public_path('images/admins'), $image_name);
        }

        Admin::create([
            'name' => $reqData['name'],
            'email' => $reqData['email'],
            'password' => Hash::make($reqData['pass']),
            'admin_area_id' => (int)$reqData['admin_area'],
            'role_id' => (int)$reqData['role'],
            'avatar' => $image_name,
            'status' => (int)$reqData['status'],
        ]);
        return response()->json(['status' => 'sucecss', 'message' => 'Admin ID Created']);
    }
    public function adminView()
    {
        $admin_data = Admin::get();

        return view('backend.pages.admin.admin_view', ['admins_data' => $admin_data]);
    }
    public function adminEdit($id)
    {
        $admin_data = Admin::where('id', $id)->first();
        return view('backend.pages.admin.admin_edit', [
            'admins_data' => $admin_data
        ]);
    }
    public function updateRequest(Request $request)
    {
        $id = $request['id'];
        try {
            $admin_data = Admin::find($id);
            $avatar = $admin_data->avatar;
            if ($request->hasFile('avatar')) {
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['avatar']->move(public_path('images/admins'), $image_name);
                if ($admin_data->avatar && file_exists(public_path('images/admins/')
                    . $admin_data->avatar)) {
                    unlink(public_path('images/admins/') . $admin_data->avatar);
                }
                $admin_data->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'admin_area_id' => $request->admin_area,
                    'role_id' => $request->role,
                    'avatar' => $request->image_name,
                    'status' => $request->status,
                ]);
                return response()->json(['status' => 'success', 'message' => 'Admin Updated successfull']);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function deleteAdmin($id)
    {
        try {
            DB::beginTransaction();
            $data = Admin::find($id);
            if ($data->avatar && file_exists(public_path('images/admins/') . $data->avatar)) {
                unlink(public_path('images/admins/') . $data->avatar);
            }
            $data->delete();
            DB::commit();
            return redirect('admins/admin_view/');
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    // ------------------
    public function Category()
    {
        return view('backend.pages.category.new_category');
    }
    public function newCategory(Request $request)
    {
        $formData = $request->all();
        if ($request->hasFile('cicon')) {
            $extension = $request->file('cicon')->getClientOriginalExtension();
            $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
            $request['cicon']->move(public_path('images/categories'), $image_name);
        }
        Category::create([
            'category_name' => $formData['cname'],
            'category_native_name' =>  $formData['cn_name'],
            'icon' => $image_name,
            'slug' => Str::slug($formData['cname']),
            'home_view' => '0',
            'status' => $formData['cstatus'] == 'active' ? true : false,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Updated']);
    }
    public function categoryView()
    {
        $category_data = Category::get();
        return view('backend.pages.category.category_view', ['categories' => $category_data]);
    }
    public function categoryEdit($id)
    {
        $categorydata = Category::where('id', $id)->first();
        return view('backend.pages.category.category_edit', ['categories' => $categorydata]);
    }
    public function updateCategory(Request $request)
    {
        $id = $request->id;
        try {
            $category_data = Category::find($id);
            $icon = $category_data->icon;
            if ($request->hasFile('cicon')) {
                $extension = $request->file('cicon')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['cicon']->move(public_path('images/categories'), $image_name);
                if ($category_data->icon && file_exists(public_path('images/categories/')
                    . $category_data->icon)) {
                    unlink(public_path('images/categories/') . $category_data->icon);
                }
                // return response()->json($category_data->icon);
                $category_data->update([
                    'category_name' => $request->cname,
                    'category_native_name' => $request->cn_name,
                    'icon' => $image_name,
                    'slug' => str::slug($request->cname),
                    'status' => $request->cstatus,
                ]);
                return response()->json(['message' => 'category Updated successfull']);
            }
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function deleteCategory($id)
    {
        try {
            DB::beginTransaction();
            $data = Category::find($id);
            if ($data->icon && file_exists(public_path('images/categories/') . $data->icon)) {
                unlink(public_path('images/categories/') . $data->icon);
            }
            $data->delete();
            DB::commit();
            return redirect('admins/category_view/');
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
    // ----------------------


    public function newUnit()
    {
        return view('backend.pages.unit.new_unit');
    }
    public function createUnit(Request $request)
    {
        $formData = $request->all();
        return response()->json($formData);
        Unit::create([
            'unit_name' => $formData['name'],
            'slug' => str::slug($formData['name']),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Unit created successfully!'
        ]);
    }
    public function unitView()
    {
        $unit_data = Unit::get();
        return view('backend.pages.unit.unit_view', ['units' => $unit_data]);
    }
    public function unitIdDelete($id)
    {
        $unit_id = Unit::find($id);
        $unit_id->delete();
        return redirect('admins/unit_view');
    }
    public function unitIdUpdate($id)
    {
        $unit_data = Unit::where('id', $id)->first();
        return view('backend.pages.unit.edit_unit', ['units' => $unit_data]);
    }
    public function updateUnit(Request $request)
    {
        $id = $request->id;
        $units = Unit::find($id);
        $units->update([
            'unit_name' => $request->name,
        ]);
        return response()->json('Updated');
    }
    // --------------------
    public function Products()
    {
        return view('backend.pages.products.products');
    }
    public function addProduct(Request $request)
    {



        // return response()->json($request->name);
        try {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/products'), $image_name);
            }
            // return response()->json($image_name);
            Product::create([
                'unit_id' => (int)$request->unit,
                'category_id' => (int)$request->category_id,
                'product_name' => $request->name,
                'product_price' => (int)$request->price,
                'product_description' => $request->des,
                'product_image' => $image_name,
                'product_available_quantity' => (int)$request->qty,
                'product_size' => $request->size,
                'color' => $request->color,
                'promoted_item' => $request->promot == 'yes' ? true : false,
                'vat' => is_numeric($request->vat) ? (float) $request->vat : 2.5,
            ]);
            return response()->json("noted");
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function productView()
    {
        $products = Product::get();
        return view('backend.pages.products.product_view', ['products' => $products]);
    }
    public function productUpdateForm($id)
    {
        $id = Product::find($id)->first();
        return view('backend.pages.products.product_edit', ['products' => $id]);
    }
    public function updateProducts(Request $request)
    {
        // return response()->json($request->all());
        try {
            $id = $request->id;
            $products_id = Product::find($id);
            $image_name = $products_id->product_image;
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/products'), $image_name);
                if ($products_id->product_image && file_exists(public_path('images/products/')
                    . $products_id->product_image)) {
                    unlink(public_path('images/products/') . $products_id->product_image);
                }
            }
            // return response()->json($id);
            $products_id->update([
                'unit_id' => (int)$request->unit,
                'category_id' => (int)$request->category_id,
                'product_name' => $request->name,
                'product_price' => (int)$request->price,
                'product_description' => $request->des,
                'product_image' => $image_name,
                'product_available_quantity' => (int)$request->qty,
                'product_size' => $request->size,
                'color' => $request->color,
                'promoted_item' => $request->promot == 'yes' ? true : false,
                'vat' => is_numeric($request->vat) ? (float) $request->vat : 2.5,
            ]);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    public function deleteProducts($id)
    {

        try {
            DB::beginTransaction();
            $del_product = Product::find($id);
            if (
                $del_product->product_image &&
                file_exists(public_path('images/products/') . $del_product->product_image)
            ) {
                unlink(public_path('images/products/') . $del_product->product_image);
            }
            $del_product->delete();
            DB::commit();
            return redirect('admins/products_view');
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
    // --------------

    public function Brands()
    {
        return view('backend.pages.brands.brand_form');
    }
    public function createBrands(Request $request)
    {
        // return response()->json($request->all());
        try {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/brands'), $image_name);
            }
            Brand::create([
                'name' => $request->name,
                'woner' => $request->woner,
                'phone' => $request->phone,
                'address' => $request->address,
                'product_name' => $request->product_name,
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
                'product_name' => $request->product_name,
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
                    'color_code' => $request->id
                ]);
                return response()->json("Color Added SuccessFully");
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    public function viewColor()
    {
        $color = Color::get();
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
        return response()->json($request->all());
        $id = $request->hid;
        $updateid = Color::find($id);
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
                $updateid->update([
                    'color_name' => $request->name,
                    'color_code' => $request->id
                ]);
                return response()->json("Color Update SuccessFully");
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // -------------------

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
                    'slug' => str::slug($request->name),
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
        $attr = Attribute::get();
        return view('backend.pages.attribute.attr_view', ['attrs' => $attr]);
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
        return view('backend.pages.attr_val.new_value');
    }
    public function newAttrValue(Request $request)
    {
        // return response()->json($request->all());
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
                $insert =  AttrValue::create([
                    'attrname_id' => (int)$request->attrname,
                    'name' => $request->name,
                    'description' => $request->des,
                    'count' => (int)$request->count,
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
        $viewdata = AttrValue::get();
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