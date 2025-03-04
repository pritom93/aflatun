<?php

use App\Http\Controllers\frontend\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('font.master.mastering');
});
Route::get('admins', [AdminController::class, 'throwBackend']);
Route::get('admin/newadmin', [AdminController::class, 'newAdmin']);
Route::post('admin/newadmin', [AdminController::class, 'createAdmin']);
Route::get('admins/admin_view', [AdminController::class, 'adminView']);
Route::get('admins/admin/update/{id}', [AdminController::class, 'adminEdit']);
Route::post('admins/update_admin', [AdminController::class, 'updateRequest']);
Route::get('admins/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);
// -------------

Route::post('admins/new_category', [AdminController::class, 'newCategory']);
Route::get('admins/category', [AdminController::class, 'Category']);
Route::get('admins/category_view', [AdminController::class, 'categoryView']);
Route::get('admins/category/delete/{id}', [AdminController::class, 'deleteCategory']);
Route::get('admins/category/update/{id}', [AdminController::class, 'categoryEdit']);
Route::post('admins/category_update', [AdminController::class, 'updateCategory']);
// -----------------------
Route::get('admins/unit', [AdminController::class, 'newUnit']);
Route::post('admins/createunit', [AdminController::class, 'createUnit']);
Route::get('admins/unit_view', [AdminController::class, 'unitView']);
Route::get('admins/unit_view/delete/{id}', [AdminController::class, 'unitIdDelete']);
Route::get('admins/unit_view/update/{id}', [AdminController::class, 'unitIdUpdate']);
Route::post('admins/update_unit', [AdminController::class, 'updateUnit']);
// -----------------

Route::get('admins/products', [AdminController::class, 'Products']);
Route::post('admins/add/product', [AdminController::class, 'addProduct']);
Route::get('admins/products_view', [AdminController::class, 'productView']);
Route::get('admins/product/update/{id}', [AdminController::class, 'productUpdateForm']);
Route::post('admins/product_update', [AdminController::class, 'updateProducts']);
Route::get('admins/product/delete/{id}', [AdminController::class, 'deleteProducts']);

// -------------
Route::get('admins/brands', [AdminController::class, 'Brands']);
Route::get('admins/brands_view', [AdminController::class, 'viewBrands']);
Route::post('admins/brand/create', [AdminController::class, 'createBrands']);
Route::post('admins/brand/update', [AdminController::class, 'UpdateBrands']);
Route::get('admins/brand/update/{id}', [AdminController::class, 'editBrands']);
Route::get('admins/brand/delete/{id}', [AdminController::class, 'deleteBrands']);
// ---------------
Route::get('admins/color', [AdminController::class, 'newColor']);
Route::get('admins/colors_view', [AdminController::class, 'viewColor']);
Route::post('admins/color', [AdminController::class, 'Color']);
Route::get('admins/color/edit/{id}', [AdminController::class, 'colorEdit']);
Route::get('admins/color/delete/{id}', [AdminController::class, 'colorDelete']);
Route::get('admins/color_update', [AdminController::class, 'colorUpdate']);
// ----------------
Route::get('admins/add/attribute', [AdminController::class, 'Attribute']);
Route::get('admins/attribute_view', [AdminController::class, 'viewAttribute']);
Route::get('admins/attr/edit/{id}', [AdminController::class, 'editAttribute']);
Route::post('admins/attr/delete', [AdminController::class, 'deleteAttribute']);
Route::post('admins/atribute', [AdminController::class, 'newAttribute']);
Route::post('admins/atribute/update', [AdminController::class, 'updateAttribute']);
// ------------------------
Route::get('admins/attr/attr_val', [AdminController::class, 'attrValue']);
Route::post('admins/attr/new_attr_val', [AdminController::class, 'newAttrValue']);
Route::get('admins/attr/view_attr_val', [AdminController::class, 'viewAttrValue']);
Route::get('admins/attr/edit_attr_val/{id}', [AdminController::class, 'editAttrValue']);
Route::post('admins/attr/update_attr_val', [AdminController::class, 'updateAttrValue']);
Route::get('admins/attr/delete_attr_val/{id}', [AdminController::class, 'deleteAttrValue']);