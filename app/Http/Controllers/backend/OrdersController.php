<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\orderItem;

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

            $pdf = Pdf::loadView('backend.orders.invoice-pdf', compact('order', 'orderItems'))
              ->setPaper('a4', 'portrait'); // Set paper size if needed

                 return $pdf->download('invoice-'.$order->id.'.pdf');
        }
}
