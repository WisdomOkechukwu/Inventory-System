<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function dashboard(){
        if(Auth::user()->role === 'staff'){
            return redirect()->route('pos.index');
        }
        
        $company_id = Auth::user()->company_id;
        $today_order = DB::table('orders')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.status', 'success')
            ->select(
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('COALESCE(SUM(order_details.total), 0) as total_amount')
            )
            ->where('orders.company_id', $company_id)
            ->first();

        $orders = DB::table('orders')
            ->where('orders.company_id', $company_id)
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity')
                , 'users.name as user_name')
            ->groupBy('orders.id')
            ->orderBy('orders.created_at','DESC')
            ->limit(20)
            ->get();

        $totalOrders = $today_order->total_orders;
        $totalAmount = $today_order->total_amount;

        $in_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock','>=', 1)
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        $out_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock','<', 1)
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        $in_stock = Product::where('stock','>=', 1)
            ->where('company_id', $company_id)
            ->count();
        $out_of_stock = Product::where('stock','<', 1)
            ->where('company_id', $company_id)
            ->count();

        return view('v1.inventory.dashboard',compact('totalOrders','totalAmount', 'in_stock', 'out_of_stock', 'orders','in_stock_product','out_stock_product'));
    }

    public function orders(){
        $company_id = Auth::user()->company_id;

        $orders = DB::table('orders')
            ->where('orders.company_id', $company_id)
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity')
                , 'users.name as user_name')
            ->groupBy('orders.id')
            ->orderBy('orders.created_at','DESC')
            ->paginate(20);

        return view('v1.inventory.orders',compact('orders'));
    }

    public function inStock(){
        $company_id = Auth::user()->company_id;
        $in_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock','>=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('v1.inventory.in-stock',compact('in_stock_product'));
    }

    public function outOfStock(){
        $company_id = Auth::user()->company_id;
        $out_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock','<', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('v1.inventory.out-stock',compact('out_stock_product'));
    }
}
