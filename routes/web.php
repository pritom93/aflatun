<?php

use App\Http\Controllers\frontend\AdminController;
use App\Http\Controllers\frontend\SignUpController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\GalleryController;
use App\Http\Controllers\frontend\ContuctController;
use App\Http\Controllers\frontend\FashionController;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\backend\OrdersController;
use App\Http\Controllers\backend\DesignerController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\backend\EventController;
use App\Http\Controllers\backend\AttributeController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CartController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ColorController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SizeController;
use App\Http\Controllers\backend\UnitController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SalesReportController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\verification\EmailController;
use App\Models\Designer;
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

// Route::get('/', function () {
//     return view('font.product.fetch_products');
// });
Route::get('/', [AdminController::class, 'indexFontPage']);
Route::get('admins', [AdminController::class, 'throwBackend']);
Route::get('admin/newadmin', [AdminController::class, 'newAdmin']);
Route::post('admin/newadmin', [AdminController::class, 'createAdmin']);
Route::get('admins/admin_view', [AdminController::class, 'adminView']);
Route::get('admins/admin/update/{id}', [AdminController::class, 'adminEdit']);
Route::post('admins/update_admin', [AdminController::class, 'updateRequest']);
Route::get('admins/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);
// -------------

Route::post('admins/new_category', [CategoryController::class, 'newCategory']);
Route::get('admins/category', [CategoryController::class, 'Category']);
Route::get('admins/category_view', [CategoryController::class, 'categoryView']);
Route::get('admins/category/delete/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('admins/category/update/{id}', [CategoryController::class, 'categoryEdit']);
Route::post('admins/category_update', [CategoryController::class, 'updateCategory']);
// -----------------------
Route::get('admins/unit', [UnitController::class, 'newUnit']);
Route::post('admins/createunit', [UnitController::class, 'createUnit']);
Route::get('admins/unit_view', [UnitController::class, 'unitView']);
Route::get('admins/unit_view/delete/{id}', [UnitController::class, 'unitIdDelete']);
Route::get('admins/unit_view/update/{id}', [UnitController::class, 'unitIdUpdate']);
Route::post('admins/update_unit', [UnitController::class, 'updateUnit']);
// -----------------

Route::get('admins/products', [ProductController::class, 'Products']);
Route::post('admins/add/product', [ProductController::class, 'addProduct']);
Route::get('admins/products_view', [ProductController::class, 'productView']);
Route::get('admins/product/update/{id}', [ProductController::class, 'productUpdateForm']);
Route::post('admins/product_update', [ProductController::class, 'updateProducts']);
Route::get('admins/product/delete/{id}', [ProductController::class, 'deleteProducts']);

// -------------
Route::get('admins/brands', [BrandController::class, 'Brands']);
Route::get('admins/brands_view', [BrandController::class, 'viewBrands']);
Route::post('admins/brand/create', [BrandController::class, 'createBrands']);
Route::post('admins/brand/update', [BrandController::class, 'UpdateBrands']);
Route::get('admins/brand/update/{id}', [BrandController::class, 'editBrands']);
Route::get('admins/brand/delete/{id}', [BrandController::class, 'deleteBrands']);
// ---------------
Route::get('admins/color', [ColorController::class, 'newColor']);
Route::get('admins/colors_view', [ColorController::class, 'viewColor']);
Route::post('admins/color', [ColorController::class, 'Color']);
Route::get('admins/color/edit/{id}', [ColorController::class, 'colorEdit']);
Route::get('admins/color/delete/{id}', [ColorController::class, 'colorDelete']);
Route::post('admins/color_update', [ColorController::class, 'colorUpdate']);
// ----------------
Route::get('admins/sizes', [SizeController::class, 'size']);
Route::get('admins/size/view', [SizeController::class, 'sizeView']);
Route::post('admins/size', [SizeController::class, 'newSize']);
Route::post('admins/size/update', [SizeController::class, 'sizeUpdate']);
// Route::get('admins/size/edit/{id}', [SizeController::class, 'sizeEdit']);
Route::get('admins/size/delete/{id}', [SizeController::class, 'sizeDelete']);


Route::get('admins/add/attribute', [AttributeController::class, 'Attribute']);
Route::get('admins/attribute_view', [AttributeController::class, 'viewAttribute']);
Route::get('admins/attr/edit/{id}', [AttributeController::class, 'editAttribute']);
Route::post('admins/attr/delete', [AttributeController::class, 'deleteAttribute']); 
Route::post('admins/atribute', [AttributeController::class, 'newAttribute']);
Route::post('admins/atribute/update', [AttributeController::class, 'updateAttribute']);
// ------------------------
Route::get('admins/attr/attr_val', [AttributeController::class, 'attrValue']);
Route::post('admins/attr/new_attr_val', [AttributeController::class, 'newAttrValue']);
Route::get('admins/attr/view_attr_val', [AttributeController::class, 'viewAttrValue']);
Route::get('admins/attr/edit_attr_val/{id}', [AttributeController::class, 'editAttrValue']);
Route::post('admins/attr/update_attr_val', [AttributeController::class, 'updateAttrValue']);
Route::get('admins/attr/delete_attr_val/{id}', [AttributeController::class, 'deleteAttrValue']);
// _____________cart Details
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart',[CartController::class, 'cartView']);
Route::post('/remove-cart', [CartController::class, 'removeCartItem']);
// ----------------------
Route::get('/login_user',[AuthController::class, 'logInUsers'])->name('login_user');
Route::post('/login_request',[AuthController::class, 'loginRequest']);


Route::post('/checkout',[OrdersController::class, 'checkOut']);
Route::get('logout',[AuthController::class, 'logout'])->name('logout');

// ____________________signUp
Route::get('/signup_user',[SignUpController::class, 'signUp_User']);
Route::post('/signup_submit',[SignUpController::class, 'submitSignUp']);
Route::get('admins/client-view',[SignUpController::class, 'clientsView']);
Route::get('user/update/{id}',[SignUpController::class, 'userUpdateForm']);
Route::get('user/delete/{id}',[SignUpController::class, 'userDelete']);

// ---------------
Route::get('view-products-details/{id}',[SignUpController::class, 'viewProductDetails']);
Route::get('playgames',[SignUpController::class, 'playGAmes']);
Route::get('gallery',[GalleryController::class, 'font_ofGallery']);
Route::get('contuct',[ContuctController::class, 'font_contuct']);
Route::get('fashion',[FashionController::class, 'font_fashion']);
Route::get('shop',[ShopController::class, 'fontShop']);



Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
Route::delete('/order/destroy/{id}', [OrdersController::class, 'destroy'])->name('order.destroy');
Route::get('/order/invoice/{id}', [OrdersController::class, 'showInvoice'])->name('invoice.show');
Route::get('/order/invoice/download/{id}', [OrdersController::class, 'downloadInvoice'])->name('invoice.download');


Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/update_user', [SignUpController::class, 'updateProfile'])->middleware('auth');
  
});
// Desiner
Route::get('admins/new-designer',[DesignerController::class, 'newDesigner']);
Route::post('/designer/store', [DesignerController::class, 'storeDesigner'])->name('designer.store');
Route::get('admins/view-designer',[DesignerController::class, 'viewDesigners']);
Route::post('admins/designer/update', [DesignerController::class, 'updateDesigner'])->name('designer.update');
Route::get('/designers/delete/{id}', [DesignerController::class, 'delete'])->name('designers.delete');

// event
Route::get('admins/new-event',[EventController::class, 'Event']);
Route::post('/event/store', [EventController::class, 'storeEvent'])->name('event.store');
Route::get('admins/view-event', [EventController::class, 'viewEvent']);
Route::post('admins/event/update', [EventController::class, 'update'])->name('events.update');
Route::get('/event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

// -----------
Route::get('admin/sliders', [SliderController::class, 'index']);
Route::post('admins/sliders', [SliderController::class, 'store']);
Route::get('admins/sliders-view', [SliderController::class, 'viewSlider'])->name('slider.index');
Route::post('admins/slider/update', [SliderController::class, 'updateSlider'])->name('slider.update');
Route::get('admins/slider/delete/{id}', [SliderController::class, 'deleteSlider']);
// -------------------------
Route::get('admins/sells-reports', [OrdersController::class, 'sellsReport']);
Route::get('admins/category-sell-reports', [OrdersController::class, 'categoryMenu']);
Route::get('admins/category-sell', [OrdersController::class, 'dataCategory']);
// Route::get('admins/category-order/{id}', [OrdersController::class, 'categoryOrder']);
Route::get('admin/call-to-order', [OrdersController::class, 'dataLoad']);
Route::get('admins/pending-orders', [OrdersController::class, 'pendingOrders']);
Route::get('admins/category-profit', [OrdersController::class, 'categoryWiseProfit']);
Route::get('admins/product-profit', [OrdersController::class, 'productProfit']);
Route::get('/generate-pdf/{categoryId}', [OrdersController::class, 'generatePdf'])->name('generate-pdf');


Route::get('admins/new-role-creating', [RoleController::class, 'roleIndex']);
Route::post('admins/new-role-insert', [RoleController::class, 'roleInsert']);


Route::get('admins/new-role-view', [RoleController::class, 'roleView']);
Route::get('/admins/role/edit/{id}', [RoleController::class, 'edit']);
Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update');
Route::post('/roles/delete', [RoleController::class, 'destroy'])->name('roles.delete');



// email------------
Route::get('admins/send-to-email', [EmailController::class, 'sendEmail']);
Route::get('admins/get/attribute-values', [EmailController::class, 'attrValueData']);

