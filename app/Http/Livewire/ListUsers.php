<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sort = 'name';
    public $direction = 'asc';
    public $cant = 8;

    public function render()
    {
        $users = User::where('deleted', false)
            ->where('name', 'like', '%'. $this->search .'%')
            ->orWhere('identification', 'like', '%' . $this->search . '%')
            ->orWhere('position', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate($this->cant);

        return view('livewire.list-users', compact('users'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            if ($this->direction == 'asc') {
                $this->direction == 'desc';
            } else {
                $this->direction == 'asc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
