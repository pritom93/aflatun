<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Role;
use App\Models\Category;


class AdminController extends Controller
{

    
    public function indexFontPage()
    {
        $products = Product::with(['product_variants.color', 'product_variants.size'])->paginate(12);
        // return $products;
        $category = Category::get();
       
        return view('font.product.index_font_page',[
            'products' => $products,
            'categories' => $category,
        ]);
   
    }
    public function throwBackend()
    {
        return view('backend.pages.dashboard');
    }
    public function newAdmin()
    {   
        $role = Role::where('status',1)->get();
        return view('backend.pages.admin.newadmin',['roles' => $role]);
    }
    public function createAdmin(Request $request)
    {

        
        $reqData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'pass' => 'required',
            'admin_area' => 'required',
            'role' => 'required',
            'status' => 'required',
            'avatar' => 'required',
        ]);

        // return response()->json($request->all());
        if ($request->hasFile('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
            $request['avatar']->move(public_path('images/admins'), $image_name);
        }
        // return response()->json($image_name);
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
        $role = Role::all();
        return view('backend.pages.admin.admin_edit', [
            'admins_data' => $admin_data,
            'roles' => $role,
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

    // --------------------

    // --------------

    

    // -------------------

    


}