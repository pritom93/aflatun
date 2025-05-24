<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\AttrValue;
use App\Models\Size;

class ProductController extends Controller
{
    public function Products()
    {
        $unit = Unit::latest()->get();
        $category = Category::latest()->get();
        $attribute = Attribute::get();
        $color = Color::get();
        $attrval = AttrValue::get();
        $size = Size::get();
        $attrvalsize = AttrValue::where('attrname_id',1)->get();
        $attrvalcolor = AttrValue::where('attrname_id',2)->get();

        return view('backend.pages.products.products', [
            'units' => $unit,
            'categories' => $category,
            'attributes' => $attribute,
            'attrvalues' => $attrval,
            'attrvaluessize' => $attrvalsize,
            'colors' => $color,
            'sizes' => $size,
            'attrvaluescolor' => $attrvalcolor
        ]);
    }
    public function addProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $image_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image'); 
                $extension = $image->getClientOriginalExtension(); 
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension; 
                $image->move(public_path('images/products'), $image_name);
            }
            $combinations = json_decode($request->input('combinations'), true);
            $product = Product::create([
                'designer_id' => (int)$request->DesinerNameID,
                'unit_id' => (int)$request->UnitIDName,
                'category_id' => (int)$request->CategoryIDName,
                'sub_category_id' => (int)$request->subCategoryName,
                'brand_id' => (int)$request->brandName,
                'name' => $request->ProducIDtName,
                'slug' => Str::slug($request->ProducIDtName),
                'price' => (int)$request->ProductIDPrice,
                'description' => $request->DescriptionIDProduct,
                'image' => $image_name,
                'available_quantity' => (int)$request->ProductIDQNTY,
                'promoted_item' => $request->subject == 'yes' ? true : false,
                'has_varient' => count($combinations) > 0 ? 1 : 0,
                'vat' => $request->ProductVAT ?? 2.5,
                'status' => (int)$request->statusID,
            ]);

            if (count($combinations) > 0) {
                foreach ($combinations as $index => $value) {
                    $variant = null; // Default value
            
                    // Retrieve uploaded file using dynamic name
                    $fileInputName = "variant_image_{$index}";
                    if ($request->hasFile($fileInputName)) {
                        $image = $request->file($fileInputName);
                        $extension = $image->getClientOriginalExtension();
                        $variant = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                        $image->move(public_path('images/products/variant'), $variant);
                    }
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size_id' => $value['sizeId'],
                        'color_id' => $value['colorId'],
                        'cost_price' => $value['costing'],
                        'price' => $value['price'],
                        'stock' => $value['stock'],
                        'sku' => $value['sku'],
                        'discount' => $value['discount'],
                        'image' => $variant,
                        'display_status' => $value['display'],
                    ]);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Product Created Successfully']);
        } catch (\Throwable $th) {
            if(file_exists(public_path('images/products/'.$image_name))){
                unlink(public_path('images/products/'.$image_name));
            }
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
    public function productView()
    {
        $products = Product::get();
        return view('backend.pages.products.product_view', ['products' => $products]);
    }
    public function productUpdateForm($id)
    {
        $unit = Unit::latest()->get();
        $category = Category::latest()->get();
        $attribute = Attribute::get();
        $attrval = AttrValue::get();
        $attrvalsize = AttrValue::where('attrname_id',1)->get();
        $attrvalcolor = AttrValue::where('attrname_id',2)->get();
        $id = Product::find($id)->first();
        $vrid = ProductVariant::where('product_id',$id)->get();
        return view('backend.pages.products.product_edit', [
            'products' => $id,
            'units' => $unit,
            'categories' => $category,
            'attributes' => $attribute,
            'attrvalues' => $attrval,
            'attrvaluessize' => $attrvalsize,
            'attrvaluescolor' => $attrvalcolor,
            'vrid' => $vrid
        ]);
    }
    public function updateProducts(Request $request)
    {
        // return response()->json($request->all());
        try {
        $id = $request->ProductHiddenID;
        $product = Product::findOrFail($id); // Get the product
        DB::beginTransaction();
        // Handle main product image update
        $image_name = $product->product_image; // Keep old image if not changed
        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
            $extension = $image->getClientOriginalExtension(); 
            $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension; 
            $image->move(public_path('images/products'), $image_name);

            // Delete old image
            if ($product->product_image && file_exists(public_path('images/products/') . $product->product_image)) {
                unlink(public_path('images/products/') . $product->product_image);
            }
        }
        // Update the product
        $product->update([
            'unit_id' => (int)$request->UnitIDName,
            'category_id' => (int)$request->CategoryIDName,
            'sub_category_id' => 0,
            'name' => $request->ProducIDtName,
            'slug' => Str::slug($request->ProducIDtName),
            'product_price' => (int)$request->ProductIDPrice,
            'description' => $request->DescriptionIDProduct,
            'product_image' => $image_name,
            'product_available_quantity' => (int)$request->ProductIDQNTY,
            'promoted_item' => $request->subject == 'yes' ? true : false,
            'has_varient' => count(json_decode($request->input('combinations'), true)) > 0 ? 1 : 0,
            'vat' => $request->ProductVAT ?? 2.5
        ]);

        // Handle variant updates
        $combinations = json_decode($request->input('combinations'), true);
        if (!empty($combinations)) {
            foreach ($combinations as $index => $value) {
                $variantImage = null;

                // Handle variant image upload
                $fileInputName = "variant_image_{$index}";
                if ($request->hasFile($fileInputName)) {
                    $image = $request->file($fileInputName);
                    $extension = $image->getClientOriginalExtension();
                    $variantImage = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                    $image->move(public_path('images/products/variant'), $variantImage);
                }

                // Find existing variant or create new
                
                $variant = ProductVariant::updateOrCreate(
                    ['product_id' => $product->id,
                     'size_id' => $value['sizeId'], 
                     'color_id' => $value['colorId']
                    ],
                    [
                        'cost_price' => $value['costing'],
                        'price' => $value['price'],
                        'stock' => $value['stock'],
                        'sku' => $value['sku'],
                        'discount' => $value['discount'],
                        'image' => $variantImage ?? ProductVariant::where([
                            'product_id' => $product->id, 
                            'size_id' => $value['sizeId'], 
                            'color_id' => $value['colorId']
                        ])->value('image') // Keep old image if no new one uploaded
                    ]
                );
            }
        }

        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Product Updated Successfully']);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
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
}
