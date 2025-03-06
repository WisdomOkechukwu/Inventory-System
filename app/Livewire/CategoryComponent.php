<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
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

        $category = Category::with('user')
            ->withCount('products')
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->where('company_id', $user->company_id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $category_count = Category::where('company_id', $user->company_id)->count();

        return view('livewire.category-component', [
            'category' => $category,
            'category_count' => $category_count
        ]);
    }
}
