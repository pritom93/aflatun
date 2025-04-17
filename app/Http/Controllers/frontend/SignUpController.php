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
use App\Models\ProductVariant;

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
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                   
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


    public function updateProfile(Request $request)
        {
            try {
                $user = Auth::user(); 
                $client = Client::where('email', $user->email)->first();
        
                if (!$client) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Client not found.'
                    ]);
                }
        
                // Check old password before allowing update
                if (!Hash::check($request->old_password, $user->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Old password does not match.'
                    ]);
                }
        
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully.'
                ]);
        
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong.',
                    'error' => $th->getMessage()
                ]);
            }
        }


    public function userUpdateForm($id)
    {
        return view('font.profile.update_profile');
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

    
    public function viewProductDetails($id){
        $products = Product::with(['colors:id,color_name,color_code','sizes:id,size_name','product_variants:id,product_id,color_id,size_id,price,stock,sku,image'])
            ->find($id);
            // return $products;    
        return view('font.product.view_details', compact('products'));
    }

    
}
