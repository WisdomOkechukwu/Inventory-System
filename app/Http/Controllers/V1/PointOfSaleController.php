<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Livewire\PointOfSale;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PointOfSaleController extends Controller
{
    public function index(){
        $reference = '';
        return view('v1.pos', compact('reference'));
    }

    public function saved_pos(){
        $orders = DB::table('orders')
            ->where('orders.status', 'pending')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.*', DB::raw('COUNT(order_details.id) as order_details_count'), DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('orders.id')
            ->get();

        return view('v1.saved_pos', compact('orders'));
    }

    public function view_order($id){
        $order = Order::find($id);
        if($order){
            $order_details = OrderDetails::with('product')->where('order_id', $order->id)->get();
            $data = [];
            foreach ($order_details as $order_detail) {
                $data[$order_detail->product->id] = [
                    'name' => $order_detail->product->name,
                    'price' => $order_detail->product->price,
                    'image' => $order_detail->product->image,
                    'quantity' => $order_detail->quantity,
                    'total' => $order_detail->total
                ];
            }

            Session::put('cart', $data);

            $reference = $order->reference;
            return view('v1.pos', compact('reference'));
        }

        $reference = '';
        return view('v1.pos', compact('reference'));
    }

    public function cancel_order($id){
        $order = Order::find($id);
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('pos.saved')->with(['success' => 'Order Cancelled Successfully']);
    }
}
