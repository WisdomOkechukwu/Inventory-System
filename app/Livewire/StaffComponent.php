<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StaffComponent extends Component
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
        $staff = User::where('id','!=',$user->id)
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->where('company_id', $user->company_id)
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $total_staff = User::where('id','!=',$user->id)
            ->where('company_id', $user->company_id)
            ->count();

        return view('livewire.staff-component', [
            'staff' => $staff,
            'total_staff' => $total_staff,
        ]);
    }
}
