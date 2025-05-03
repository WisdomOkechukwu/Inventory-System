<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersList extends Component
{
    use WithPagination;

    public $search = '';
    public $dateFrom = '';
    public $dateTo = '';

    protected $queryString = ['search', 'dateFrom', 'dateTo'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $company_id = Auth::user()->company_id;

        $orders = DB::table('orders')
            ->where('orders.company_id', $company_id)
            // ->whereIn('orders.payment_type', ['POS','CASH'])
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity'), 'users.name as user_name')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('orders.reference', 'like', '%' . $this->search . '%')
                        ->orWhere('orders.status', 'like', '%' . $this->search . '%')
                        ->orWhere('orders.payment_type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->dateFrom, function ($query) {
                $query->where('orders.created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->where('orders.created_at', '<=', $this->dateTo);
            })
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(1000);

        $data = DB::table('orders')
            ->where('orders.company_id', $company_id)
            ->whereIn('orders.payment_type', ['POS','CASH'])
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.payment_type', DB::raw('SUM(order_details.total) as total_amount'), DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->when($this->dateFrom, function ($query) {
                $query->where('orders.created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->where('orders.created_at', '<=', $this->dateTo);
            })
            ->groupBy('orders.id')
            ->get();
        return view('livewire.orders-list', [
            'orders' => $orders,
            'data' => $data,
        ]);
    }
}
