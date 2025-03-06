<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductComponent extends Component
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
        $user = Auth::user();

        $product = Product::with('category')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->where('company_id', $user->company_id)
            ->where('is_active', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $product_count = Product::where('company_id', $user->company_id)->count();

        return view('livewire.product-component', [
            'product' => $product,
            'product_count' => $product_count,
        ]);
    }
}
