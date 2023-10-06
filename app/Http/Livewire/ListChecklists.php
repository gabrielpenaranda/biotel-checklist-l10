<?php

namespace App\Http\Livewire;
use App\Models\Checklist;
use Livewire\WithPagination;

use Livewire\Component;

class ListChecklists extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sort = 'name';
    public $direction = 'asc';
    public $cant = 8;
    public $status = "3";

    public function render()
    {
        if ($this->status === '3') {
            $checklists = Checklist::where('name', 'like', '%'. $this->search .'%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('priority', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->paginate($this->cant);
        } else {
            $checklists = Checklist::where('status', $this->status)
                ->orderBy('created_at', 'desc')
                ->orderBy('id', 'desc')
                ->paginate($this->cant);
        }

        return view('livewire.list-checklists', compact('checklists'));
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
