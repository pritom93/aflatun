<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // return response()->json($request->all());
        $cart = Session::get('cart', []);

        $found = false;
    
        // Loop through cart to check if product already exists
        foreach ($cart as &$item) {
            if (
                $item['product_id'] == $request->product_id &&
                $item['color'] == $request->color &&
                $item['size'] == $request->size
            ) {
                $item['quantity'] += $request->quantity; // Increase quantity
                $found = true;
                break;
            }
        }
    
        // If product is not in cart, add it as a new entry
        if (!$found) {
            $cart[] = [
                'product_id' => $request->product_id,
                'name' => $request->name,
                'price' => $request->price,
                'color' => $request->color,
                'quantity' => $request->quantity,
                'image' => $request->image,
                'size' => $request->size,
            ];
        }
    
        Session::put('cart', $cart);
    
        // Calculate total cart quantity
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
    
        return response()->json([
            'message' => 'Product added to cart!',
            'cart_count' => $totalQuantity
        ]);
    }
    public function cartView()
    {
        return view('font.product.addtoart');
    }
    public function removeCartItem(Request $request)
    {
        $cart = Session::get('cart', []);
        $id = $request->id;
        $colorid = $request->colorid;
        $sizeid = $request->sizeid;
        $cart = array_filter($cart, function($item) use ($id, $colorid, $sizeid) {
            return !($item['product_id'] == $id && $item['color'] == $colorid && $item['size'] == $sizeid);
        });
        Session::put('cart', $cart);
        return response()->json(['message' => 'Product removed from cart!']);
    }
}
