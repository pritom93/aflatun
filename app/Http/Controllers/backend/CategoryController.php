<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Category()
    {
        $category = Category::get();
        return view('backend.pages.category.new_category', [
            'categories' => $category
        ]);
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
            'slug' => Str::slug($formData['cname']),
            'category_native_name' =>  $formData['cn_name'],
            'parent_categroy' => (int) $formData['parent'] ?? 0,
            'icon' => $image_name,
            'home_view' => '0',
            'status' => $formData['cstatus'] == 'active' ? true : false,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Inserted']);
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
}
