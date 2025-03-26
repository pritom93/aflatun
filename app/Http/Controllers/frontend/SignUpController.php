<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Client;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductVarient;

class SignUpController extends Controller
{
    public function signUp_User()
    {
        return view('font.user.users');
    }
   
    public function submitSignUp(Request $request)
    {
        // return response()->json($request->all());

        try {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->getClientOriginalExtension();
                $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
                $request['image']->move(public_path('images/clients'), $image_name);
            }
            // return response()->json($request->firstName);
   
            $client = Client::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'division' => $request->division,
                'district' => $request->district,
                'home_district' => $request->homeDistrict,
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password), 
                'terms_accepted' => $request->termsAccepted === "Yes" ? 1 : 0,
                'image' => $image_name,
            ]);
            if($client){
                User::create([
                    'name' => $request->firstName,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                   
                ]);
            }

        
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully'
               
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => 'error',
                'message' => 'Dhame',
                'data' => $th
            ]);
        }

    }
    public function clientsView()
    {
        $client = Client::get();
        return view('backend.pages.client.client_view',[
            'clients' => $client
        ]);
    }
    public function userUpdateForm($id)
    {
        return "okey";
    }
    public function userDelete($id)
    {
        try {
            DB::beginTransaction();
            $client_data = Client::find($id);
            if ($client_data->image && file_exists(public_path('images/clients/') .
             $client_data->image)) {
                unlink(public_path('images/clients/') . $client_data->image);
            }
            $client_data->delete();
            DB::commit();
            return redirect('admins/client-view/');
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

  
    public function playGAmes()
    {
        return view('font.games.game');
    }

    public function checkOut(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        //  return response()->json($data);
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email',
                'address' => 'required|string',
                'payment' => 'required|string',
                'receiving' => 'nullable|string',
                'shipping' => 'required|numeric',
                'subtotal' => 'required|numeric',
                'tax' => 'required|numeric',
                'total' => 'required|numeric',
                'cart' => 'required|array',
            ]);
    
            // Insert order data into the database
            $order = Order::create([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'payment_method' => $validatedData['payment'],
                'receiving_time' => $validatedData['receiving'] ?: null,
                'shipping_charge' => $validatedData['shipping'],
                'subtotal' => $validatedData['subtotal'],
                'tax' => $validatedData['tax'],
                'total' => $validatedData['total'],
            ]);
            foreach ($validatedData['cart'] as $item) {
                // return response()->json($item);
                orderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['product'],
                    'color' => $item['color'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
            Session::forget('cart');
     

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
            'cart_cleared' => true 
        ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'cart_cleared' => false 
            ], 201);
        }
        
    }
    public function viewProductDetails($id){
        $products = Product::with(['colors:id,color_name,color_code','sizes:id,size','product_varients:id,product_id,color_id,size_id,price,stock,sku,image'])
            ->find($id);
            // return $products;    
        return view('font.product.view_details', compact('products'));
    }

    
}
