<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
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
            $order = Order::with(['client', 'user', 'orderItems.product'])->findOrFail($id);

            return view('backend.pages.orders.invoice', compact('order'));
        }

        // Generate PDF
        public function downloadInvoice($id)
    {
        
        $order = Order::with(['user', 'orderItems.product', 'orderItems.color'])->findOrFail($id);    
        $orderItems = $order->orderItems;
        $pdf = Pdf::loadView('backend.pages.orders.invoice-pdf', compact('order', 'orderItems'))
                ->setPaper('a4', 'portrait'); 
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

        public function checkOut(Request $request)
    {
    $validatedData = $request->validate([
        'payment' => 'required|string',
        'receiving' => 'nullable|string',
        'shipping' => 'required|numeric',
        'tax' => 'required|numeric',
        'cart' => 'required|array',
        'cart.*.product_id' => 'required|integer',
        'cart.*.color' => 'required|integer',
        'cart.*.size' => 'required|integer',
        'cart.*.quantity' => 'required|integer|min:1',
    ]);

    try {
        $cart = $request->input('cart', []);
        $subTotal = 0;

        DB::beginTransaction();

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'payment_method' => $validatedData['payment'],
            'payment_status' => 0,
            'shipping_charge' => $validatedData['shipping'],
            'discount' => 0,
            'subtotal' => 0, // will be updated later
            'tax' => $validatedData['tax'],
            'total' => 0, // will be updated later
            'delivery_status' => 0,
            'delivery_date' => $validatedData['receiving'] ?? null,
            'order_status' => 0,
            'order_date' => now(),
            'created_at' => now(),
        ]);

        // Add Order Items
        foreach ($cart as $item) {
            $variant = ProductVariant::where([
                'product_id' => $item['product_id'],
                'color_id' => $item['color'],
                'size_id' => $item['size'],
            ])->first();

            if (!$variant) {
                throw new \Exception("Variant not found for product ID {$item['product_id']}");
            }

            $quantity = $item['quantity'];
            $unitPrice = $variant->price;
            $totalPrice = $unitPrice * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'color_id' => $item['color'],
                'size_id' => $item['size'],
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'discount' => 0,
                'created_at' => now(),
            ]);

            // Decrease stock
            $variant->decrement('stock', $quantity);

            $subTotal += $totalPrice;
        }

        // Update order totals
        $total = $subTotal + $validatedData['shipping'] + $validatedData['tax'];

        $order->update([
            'subtotal' => $subTotal,
            'total' => $total,
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
        return response()->json([
            'message' => $th->getMessage(),
            'cart_cleared' => false
        ], 400);
    }
}

    public function sellsReport()
    {       
        return view('backend.pages.reports.sells_reports');
    }
    public function categoryMenu()
    {
        return view('backend.pages.reports.category_sell_report');
    }

    public function dataCategory(Request $request)
    {
        $query = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.category_id', 'categories.category_name as cat_name',
                DB::raw('SUM(total_price) as total_sale'), 
                DB::raw('SUM(quantity) as sale_quantity'));

        // Filter by date if provided
        if ($request->start_date) {
            $query->whereDate('order_items.created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('order_items.created_at', '<=', $request->end_date);
        }

        $category = $query->groupBy(['products.category_id', 'categories.category_name'])
                        ->orderByDesc('sale_quantity')
                        ->get();

        return response()->json($category);
    }

    public function dataLoad(Request $request)
    {
        $query = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'orders.*');

        if ($request->start_date) {
            $query->whereDate('orders.created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('orders.created_at', '<=', $request->end_date);
        }

        $reports = $query->orderBy('orders.created_at', 'desc')->get();

        return response()->json($reports);
    }

    public function pendingOrders(){
        $orders = DB::table('orders')
        ->rightJoin('order_items','order_items.order_id','=','orders.id')
        ->select('order_items.unit_price','order_items.unit_price',)
        ->where('order_status', 0)
        ->get();
        return view('backend.pages.reports.pending_order',['orders' => $orders]); 
    }

    public function categoryWiseProfit()
    {
        $categories = Category::with('products.product_variation')->get();
        // return $categories;
    // Calculate sold quantity, total revenue, total cost per category

        return view('backend.pages.reports.category_wise_profit', compact('categories'));
    }

    public function productProfit(){
        $products = Product::with(['orderItems.order.client.productVariants'])->get();
        // You can calculate sold quantity, revenue, cost per product here

        return view('backend.pages.reports.product_profit', compact('products'));
    }


    public function generatePdf($categoryId)
    {
        // Fetch the category data by its ID
        $category = Category::with('products.product_variation')->findOrFail($categoryId);
        // return $category;
        // Generate the PDF using the category data
        $pdf = PDF::loadView('backend.pages.reports.pdf_category_profit', compact('category'));

        // Return the generated PDF as a download
        return $pdf->download('category-wise-profit.pdf');
    }
    

}
