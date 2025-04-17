<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function index()
        {
            $orders = Order::orderBy('id', 'desc')->get();
            return view('backend.pages.orders.orders', compact('orders'));
        }

    public function destroy($id)
        {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->back()->with('success', 'Order deleted successfully!');
        }


        public function showInvoice($id)
        {
            $order = Order::findOrFail($id);
            $orderItems = OrderItem::where('order_id', $id)->get();
            return view('backend.pages.orders.invoice', compact('order', 'orderItems'));
        }

        // Generate PDF
        public function downloadInvoice($id)
        {
            $order = Order::findOrFail($id);
            $orderItems = OrderItem::where('order_id', $id)->get();

            $pdf = Pdf::loadView('backend.pages.orders.invoice-pdf', compact('order', 'orderItems'))
              ->setPaper('a4', 'portrait'); // Set paper size if needed

                 return $pdf->download('invoice-'.$order->id.'.pdf');
        }

        public function checkOut(Request $request)
    {
        $validatedData = $request->validate([
                'payment' => 'required|string',
                'receiving' => 'nullable|string',
                'shipping' => 'required|numeric',
                'subtotal' => 'required|numeric',
                'tax' => 'required|numeric',
                'total' => 'required|numeric',
                'cart' => 'required|array',
            ]);
            
            try {
            $cart = Session::get('cart', []);
            // return response()->json($cart);
            $subTotal = 0;
            // Insert order data into the database
            DB::beginTransaction();
            $order = Order::create([
                'user_id' => Auth::id(),
                'payment_method' => $validatedData['payment'],
                'payment_status' => 0,
                'shipping_charge' => $validatedData['shipping'],
                'discount' => 0,
                'subtotal' => $subTotal,
                'tax' => $validatedData['tax'],
                'total' => $subTotal+$validatedData['tax']+$validatedData['shipping'],
                'delivery_status' => 0,
                'delivery_date' => $validatedData['receiving'] ?? null,
                'order_status' => 0,
                'order_date' => now(),
                'created_at' => now(),
            ]);
            
            foreach ($cart as $item) {
                // return response()->json($item);
                $varient = ProductVariant::where([
                    'product_id' => $item['product_id'],
                    'color_id' => $item['color'],
                    'size_id' => $item['size']
                ])->first();
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'color_id' => $item['color'],
                    'size_id' => $item['size'],
                    'unit_price' => $varient->price,
                    'quantity' => $item['quantity'],
                    'total_price' => $varient->price * $item['quantity'],
                    'discount' => 0,
                    'created_at' => now(),
                ]);
                $subTotal += $varient->price * $item['quantity'];
            }
            $order->update([
                'subtotal' => $subTotal,
                'total' => $subTotal + $validatedData['shipping'] + $validatedData['tax'],
            ]);
            Session::forget('cart');
            DB::commit();

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
            'cart_cleared' => true 
        ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
            return response()->json([
                'message' => $th,
                'cart_cleared' => false 
            ], 400);
        }
        
    }

}
