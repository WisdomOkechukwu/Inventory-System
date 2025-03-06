<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InStockComponent extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search', 'dateFrom', 'dateTo'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $company_id = Auth::user()->company_id;
        $in_stock_product = Product::with('category')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->where('stock','>=', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('livewire.in-stock-component', [
            'in_stock_product' => $in_stock_product
        ]);
    }
}
