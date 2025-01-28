<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $searchOrderId = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearchOrderId()
    {
        $this->resetPage('ordersPage');
    }

    public function render()
    {
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

        $totalOrders = $today_order->total_orders;
        $totalAmount = $today_order->total_amount;

        $orders = DB::table('orders')
            ->where('orders.company_id', $company_id)
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity'), 'users.name as user_name')
            ->groupBy('orders.id')
            ->when($this->searchOrderId, function ($query) {
                $query->where('orders.reference', 'like', "%{$this->searchOrderId}%");
            })
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(10, ['*'], 'ordersPage');

        $in_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock', '>=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20, ['*'], 'inStockPage');

        $out_stock_product = Product::with('category')
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock', '<', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20, ['*'], 'outStockPage');

        $in_stock = Product::where('stock', '>=', 1)->count();
        $out_of_stock = Product::where('stock', '<', 1)->count();

        return view('livewire.dashboard', [
            'totalOrders' => $totalOrders,
            'totalAmount' => $totalAmount,
            'in_stock' => $in_stock,
            'out_of_stock' => $out_of_stock,
            'orders' => $orders,
            'in_stock_product' => $in_stock_product,
            'out_stock_product' => $out_stock_product
        ]);
    }
}
